<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Info;
use App\Http\Requests\ShuffleCardRequest;
use Illuminate\Http\JsonResponse;

class MainController extends Controller
{
    // return title and description from database
    public function getInfo(): JsonResponse
    {
        $info = Info::find(1);

        $title = $info->title ?? 'Default Title';
        $description = $info->description ?? 'Lorem Ipsum is simply dummy text of the industry standard dummy text';

        $datas = [
            'title' => $title,
            'description' => $description,
        ];

        return response()->json($datas, 200);
    }

    // return random cards by input totalPlayerNumber
    public function shuffleCard(ShuffleCardRequest $request): string
    {
        $inputs = $request->validated();
        $totalPlayerCount = (int) $inputs['totalPlayerNumber'];

        $cards = $this->getCards();
        shuffle($cards);

        $eachPersonCards = $this->getEachPersonCards($cards, $totalPlayerCount);

        $output = '';
        foreach ($eachPersonCards as $personCards) {
            foreach ($personCards as $card) {
                $output .= $card . ',';
            }
            $output = rtrim($output, ',');
            $output = $output . PHP_EOL;
        }

        return $output;
    }

    // return 52 cards
    private function getCards(): array
    {
        // S = Spade | H = Heart | D = Diamond | C = Club
        $cardSymbols = ['S', 'H', 'D', 'C'];

        $cardNums = ['A', '2', '3', '4', '5', '6', '7', '8', '9', 'X', 'J', 'Q', 'K'];

        $cards = [];
        foreach ($cardSymbols as $cardSymbol) {
            foreach ($cardNums as $cardNum) {
                $cards[] = $cardSymbol . '-' . $cardNum;
            }
        }

        return $cards;
    }

    // return card for each person
    private function getEachPersonCards(array $cards, int $totalPlayerCount): array
    {
        $totalCardCount = count($this->getCards());
        $eachPersonCards = [];
        for ($j = 0; $j < $totalCardCount; $j++) {
            for ($i = 0; $i < $totalPlayerCount; $i++) {
                if (empty($cards)) {
                    break;
                }
                $eachPersonCards[$i][$j] = array_pop($cards);
            }
        }

        return $eachPersonCards;
    }
}
