<?php

/**
 * speedAndStrengthGenerator is a function which generates speed and strength of teamplayers.
 * 
 * @param totalScoreArr is an array which consists of total attributeScore of each player
 * 
 * @return array of spped and Strength
 */
function speedAndStrengthGenerator($totalScoreArr = array())
{
    $scores = array();
    $speed = rand(1, 30);
    $strength = rand(1, 30);
    $totalScore = $speed + $strength;
    if (in_array($totalScore, $totalScoreArr)) {
        return speedAndStrengthGenerator($totalScoreArr);
    } else {
        $scores["Speed"] = $speed;
        $scores["Strength"] = $strength;
        return $scores;
    }
}

/**
 * team is a function which generate team playes and their speed and strength
 *
 * @param teamname is a name of a team
 * 
 * @return array of team
 */
function team($teamname)
{
    $team = array();
    $mainPlayers = array();
    $substitutePlayers = array();
    $teamMemberTotals = array();
    for ($i = 0; $i < 15; $i ++) {
        if ($i < 10) {
            $scores = speedAndStrengthGenerator($teamMemberTotals);
            $playerName = $teamname . "Player" . ($i + 1);
            $mainPlayers[$playerName]["Speed"] = $scores["Speed"];
            $mainPlayers[$playerName]["Strength"] = $scores["Strength"];

            $tmp1 = $mainPlayers[$playerName]["Speed"] + $mainPlayers[$playerName]["Strength"];

            array_push($teamMemberTotals, intval($tmp1));
        } else if ($i >= 10) {
            $scores = speedAndStrengthGenerator($teamMemberTotals);
            $playerName = $teamname . "Player" . ($i + 1);
            $substitutePlayers[$playerName]["Speed"] = $scores["Speed"];
            $substitutePlayers[$playerName]["Strength"] = $scores["Strength"];

            $tmp2 = $substitutePlayers[$playerName]["Speed"] + $substitutePlayers[$playerName]["Strength"];

            array_push($teamMemberTotals, intval($tmp2));
        }
    }

    $team["Starters"] = $mainPlayers;
    $team["Substitutes"] = $substitutePlayers;

    print var_export($teamMemberTotals);
    return $team;
}

/**
 * teams is a function which creates array of teams
 *
 * @param n is number of team of team you need to create
 *            
 * @return array
 */
function teams($n)
{
    $teams = array();
    for ($i = 0; $i < $n; $i ++) {
        $team = team("Team" . ($i + 1));
        array_push($teams, $team);
    }
    return $teams;
}
