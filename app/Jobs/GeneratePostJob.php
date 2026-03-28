<?php

namespace App\Jobs;

use App\Models\Post;
use App\Services\GeminiClient;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class GeneratePostJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;
    public int $timeout = 120;

    public function handle(): void
    {
        // Prevent duplicate for today
        $alreadyExists = Post::whereDate('created_at', now())->exists();

        // if ($alreadyExists) {
        //     Log::info('Daily post already exists, skipping generation.');
        //     return;
        // }

        $topic = $this->pickTopic();

        $prompt = $this->buildPrompt($topic);

        // Use the local GeminiClient service to call the Generative Language API.
        $client = new GeminiClient(env('GEMINI_API_KEY'), env('GEMINI_MODEL'));

        try {
            $raw = $client->generateText($prompt);
        } catch (\Throwable $e) {
            Log::error('Gemini API call failed', ['error' => $e->getMessage()]);
            return;
        }
        
        $data = $this->parseResponse($raw);

        $autoPublish = (bool) env('AUTO_PUBLISH_GENERATED_POSTS', true);

        Post::create([
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
            'content' => $data['content'] ?? null,
            'published' => $autoPublish,
        ]);

        Log::info('Daily post generated', ['title' => $data['title'], 'published' => $autoPublish]);
    }

    private function pickTopic(): string
    {
        $topics = [
            // Bieren
            "Iconisch abdijbier",
            "Experimentele craft IPA",
            "Historisch vergeten bierstijl",
            "Lokaal gebrouwen pilsener",
            "Zeldzaam vintage bier",
            "Alcoholvrij speciaalbier",
            "Extreem zware stout",
            "Fris seizoensbier",

            // Brouwers & Vakmanschap
            "Innovatieve microbrouwer",
            "Traditionele brouwmeester",
            "Duurzame stadsbrouwerij",
            "Vrouwelijke brouw-pionier",
            "Huisbrouwer vertelt",
            "Brouwerij in een klooster",
            "High-tech bierlab",

            // Interviews & Personen
            "Interview: De fanatieke verzamelaar",
            "Interview: De kritische biersommelier",
            "Interview: De eigenaar van een bruine kroeg",
            "Interview: De beginnende hobbybrouwer",
            "Interview: De Untappd-expert",
            "Interview: De geheelonthouder in de kroeg",
            "Interview: De festivalorganisator",

            // Cultuur & Lifestyle
            "Bier en foodpairing experiment",
            "De toekomst van de bierwereld",
            "Bier-etiquette discussie",
            "De invloed van marketing op smaak",
            "Bier als cultureel erfgoed",
            "De perfecte bier-roadtrip"
        ];

        return $topics[array_rand($topics)];
    }

    private function buildPrompt(string $topic): string
    {
        return <<<PROMPT
Je bent een erudiete en bevlogen bierschrijver voor "Het Bier en Plezier Blog", een prestigieus en verfijnd tijdschrift over de kunst van het brouwen en de cultuur van bier.

Schrijf een meeslepende blogpost over: {$topic}

ENGINEERING RICHTLIJNEN VOOR LAYOUT & STIJL:
- Gebruik een rijke variëteit aan HTML-elementen om een luxueuze redactionele lay-out te creëren.
- Begin de 'content' met een sfeervolle inleiding, gevolgd door een <blockquote> die de essentie van het onderwerp vangt.
- Gebruik <h2> voor de hoofdsecties en <h3> voor verdiepende nuances.
- Integreer subtiele styling-elementen: gebruik <strong> voor nadruk op kernbegrippen en <em> voor proefnotities of emotionele accenten.
- Zorg voor een ritmische afwisseling tussen korte, krachtige alinea's en langere, beschrijvende passages.

TONEEL: Verfijnd, nieuwsgierig en toegankelijk. Vermijd een droge academische toon; schrijf als een kenner die met een goed glas in de hand vertelt aan een gewaardeerde vriend.

OUTPUT: Je MOET antwoorden met UITSLUITEND valide JSON — geen Markdown-blokken, geen inleidende tekst — in exact dit formaat:
{
  "title": "Een pakkende, elegante titel (max. 80 tekens)",
  "description": "Eén verleidelijke samenvatting die uitnodigt tot lezen (max. 200 tekens)",
  "content": "Volledige HTML-artikelinhoud. Gebruik <p>, <h2>, <h3>, <blockquote>, <ul>, <li>, <strong>, <em>. Minimaal 500 woorden. Geen <html>, <head> of <body> tags."
}
PROMPT;
    }

    private function parseResponse(string $raw): array
    {
        // Strip possible fences and parse JSON
        $clean = preg_replace('/```json|```/', '', $raw);
        $data = json_decode(trim($clean), true);

        if (json_last_error() !== JSON_ERROR_NONE || ! isset($data['title'], $data['content'])) {
            Log::error('Gemini response parse failed', ['raw' => $raw]);
            throw new \RuntimeException('Invalid JSON from Gemini: ' . json_last_error_msg());
        }

        return $data;
    }

    public function failed(\Throwable $e): void
    {
        Log::error('GeneratePostJob failed', ['error' => $e->getMessage()]);
    }
}
