<?php

namespace Modules\File\Domain\Services;

use Modules\File\Domain\Contracts\OcrExtractServiceInterface;
use thiagoalessio\TesseractOCR\TesseractOCR;

class OcrExtractService implements OcrExtractServiceInterface
{
    public function getText(string $path): string
    {
        return (new TesseractOCR($path))
            ->lang('spa')
            ->run();
    }

    public function getHexagonalText(string $path): string
    {
        $hocr = (new TesseractOCR($path))
            ->lang('spa')
            ->hocr()
            ->run();

        $dom = new \DOMDocument;
        @$dom->loadHTML($hocr);
        $xpath = new \DOMXPath($dom);
        $map = [];

        foreach ($xpath->query("//span[@class='ocrx_word']") as $word) {
            $title = $word->getAttribute('title');
            if (preg_match('/bbox (\d+) (\d+) (\d+) (\d+)/', $title, $matches)) {
                $map[] = [
                    't' => $word->nodeValue,
                    'b' => [(int) $matches[1], (int) $matches[2], (int) $matches[3], (int) $matches[4]],
                ];
            }
        }

        return json_encode(array_slice($map, 0, 600), JSON_PRETTY_PRINT);
    }
}
