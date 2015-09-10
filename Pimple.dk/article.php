<?php
require_once("setup.php");
$smarty = SmartyPants::instance();

$smarty->assign("rootDir", $rootDir);

$date = $_GET["date"];
$title = $_GET["title"];

// echo $date . " - " . $title;

$smarty->assign("subject", ucwords(str_replace("-", " ", $title)));
$smarty->assign("publisher", "Henrik B. Nørgaard");
$smarty->assign("published", $date . " 01:12");

$code =
	"// http://www.steamdev.com/snippet/

$(document).ready(function()
{
	$(\"pre.html\").snippet(\"html\");
	$(\"pre.css\").snippet(\"css\", {style: \"peachpuff\"});
	$(\"pre.js\").snippet(\"javascript\", {style: \"peachpuff\"});
});";

$longCode =
	"package com.frazers.android_whist_assignment2.model;

import com.frazers.android_whist_assignment2.service.Service;

import java.util.ArrayList;
import java.util.Calendar;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

/**
 * Created by Frazers on 06-03-2015.
 */
public class Game {
    private String name;
    private List<Round> rounds;
    private Map<String, Player> players;

    public Game() {
        this.rounds = new ArrayList<Round>();
        this.players = new HashMap<String, Player>();
    }

    public Game(String name, Map<String, Player> players) {
        if (name.equals(\"\"))
            this.name = Calendar.getInstance().toString();
        else
            this.name = name;
        this.rounds = new ArrayList<Round>();
        rounds.add(new Round(rounds.size(), null, null, null, null));
        this.players = players;
    }

    public void addRound(Map<Player, Boolean> result, Type type, Player bidder, Player partner, Player dealer) {
        Round round = rounds.get(rounds.size() - 1);

        int winners = 0;
        int losers = 0;
        for (Boolean winner : result.values()) {
            if (winner == true)
                winners++;
            else
                losers++;
        }

        Integer[] outcome = Service.getInstance().calculateOutcome(type, winners, losers);

        round.setType(type);
        round.setPartner(partner);
        round.setDealer(dealer);
        round.setBidder(bidder);

        for (Player player : result.keySet()) {
            if (result.get(player) == true)
                round.addResult(player, outcome[0]);
            else
                round.addResult(player, outcome[1]);
        }
        rounds.add(new Round(rounds.size(), null, null, null, null));
    }

    public Map<String, Player> getPlayers() {
        return players;
    }

    public void setPlayers(Map<String, Player> players) {
        this.players = players;
    }

    public List<Round> getRounds() {
        return rounds;
    }

    public void setRounds(List<Round> rounds) {
        this.rounds = rounds;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public Map<Player, Double> getGameResults() {
        Map<Player, Double> gameResults = new HashMap<Player, Double>();

        for (Player player : players.values()) {
            int result = 0;
            for (Round round : rounds) {
                if (round.getResults().containsKey(player))
                    result += round.getResults().get(player);
            }
            gameResults.put(player, result / 100.0);
        }
        return gameResults;
    }
}";

$smarty->assign("content", "<p>This is the content of the website.</p><pre class=\"js\"><code>{$code}</code></pre><pre class=\"cppColl\"><code>{$longCode}</code></pre><p>And so is this. And oh look, a <a href=\"index.php\">link</a>.</p>");

$smarty->display("article.tpl");
?>