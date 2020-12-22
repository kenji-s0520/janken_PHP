<!--
40 じゃんけんを作成しよう！
下記の要件を満たす「じゃんけんプログラム」を開発してください。
要件定義
・使用可能な手はグー、チョキ、パー
・勝ち負けは、通常のじゃんけん
・PHPファイルの実行はコマンドラインから。
ご自身が自由に設計して、プログラムを書いてみましょう！
-->
​
<!--
    じゃんけんで必要な要素      自分の出す手と相手の出す手（自分の手は標準入力と相手の手は配列を用いてランダムに出力
                            それぞれが出した手の結果（条件式を用いる）
                            結果があいこであった場合は再度ジャンケンする（再帰関数を使う）
-->
​
<?php

const ROCKPAPERSCISSORS = "1: グー、2: チョキ、3: パー";

const STONE = 1;
const SCISSORS = 2;
const PAPER = 3;

const HAND_TYPE = array(
    STONE => "グー",
    SCISSORS => "チョキ",
    PAPER => "パー"
);

const WIN = 2;
const LOSE = 1;
const EVEN = 0;

const YES = "Y";
const NO = "N";

const RESTART = "もうひと勝負しましょう。";
const END = "お疲れ様でした。";

const MESSAGEINPUT = "YかNを入力してください";
const MESSAGEINVALID = "YとN以外の入力は無効です！";


function validation($player_hand){
    if(empty($player_hand) === true){
        echo "ジャンケンをしてください！".PHP_EOL;
        return false;
    }

    if($player_hand != STONE && $player_hand != SCISSORS && $player_hand != PAPER){
        echo "グー、チョキ、パー以外の入力は無効です！".PHP_EOL;
        return false;
    }
    return true;
}

function validationRestart($input_player){
    if(empty($input_player)  === true){
        echo MESSAGEINPUT.PHP_EOL;
        return false;
    }
    if($input_player != YES && $input_player != NO){
        echo MESSAGEINVALID.PHP_EOL;
        return false;
    }
    return true;
}

function getPlayerHand(){
    $player_hand = trim(fgets(STDIN));
    $check = validation($player_hand);
    if($check === false){
        return getPlayerHand();
    }
    return $player_hand;

}

function getPcHand(){
    $pc_hand = array_rand(HAND_TYPE);
    return $pc_hand;
}

function judge($player_hand, $pc_hand){
    return ($player_hand - $pc_hand + 3) % 3;
}

function show($result){
    if($result === EVEN){
        echo "あいこです！？ もう一度勝負です！".PHP_EOL;
    }
    if($result === WIN){
        echo "あなたの勝ちです。".PHP_EOL;
    }
    if($result === LOSE){
        echo "あなたの負けです。".PHP_EOL;
    }
}

function restart(){
    echo "もう一度じゃんけんゲームをしますか？".PHP_EOL;
    echo "Y/Nを入力してください。".PHP_EOL;
    $input_player = trim(fgets(STDIN));
    $check = validationRestart($input_player);
    if($check === false){
        return restart();
    }
    if($input_player === YES){
        echo RESTART.PHP_EOL;
    }
    if($input_player === NO){
        echo END.PHP_EOL;
        exit;
    }
    return $input_player;
}

function main(){
    echo ROCKPAPERSCISSORS.PHP_EOL;
    echo "1から3までの数字を入力してください".PHP_EOL;
    echo "ジャンケン、ぽん".PHP_EOL;
    $player_hand = getPlayerHand();
    echo "あなたの手:".HAND_TYPE[$player_hand].PHP_EOL;
    $pc_hand = getPcHand();
    echo "コンピュータの手:".HAND_TYPE[$pc_hand].PHP_EOL;
    $result = judge($player_hand, $pc_hand);
    show($result);
    if($result === EVEN){
        return main();
    }
    $input_player = restart();
    if($input_player === YES){
        return main();
    }
}
echo "じゃんけんゲームをしましょう！".PHP_EOL;
main();