<?php
/*%%SmartyHeaderCode:1110455aa561e369af7_52208124%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '75b348768381a6f8cbe24abe22d13b6fbe86524b' => 
    array (
      0 => 'C:\\wamp\\www\\TestApp\\templates\\article.tpl',
      1 => 1437226525,
      2 => 'file',
    ),
    'd754d6861eea2f0c2d53f1241889b8af8b0e421b' => 
    array (
      0 => 'C:\\wamp\\www\\TestApp\\templates\\modules\\header.tpl',
      1 => 1436479909,
      2 => 'file',
    ),
    '12281b6c16b9701f382654d8989c56f679722e0e' => 
    array (
      0 => 'C:\\wamp\\www\\TestApp\\templates\\modules\\navigation.tpl',
      1 => 1437233783,
      2 => 'file',
    ),
    '0ac956c859c97e6ea63d3b1748156863c0551d7a' => 
    array (
      0 => 'C:\\wamp\\www\\TestApp\\templates\\modules\\footer.tpl',
      1 => 1436483109,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1110455aa561e369af7_52208124',
  'tpl_function' => 
  array (
  ),
  'version' => '3.1.27',
  'unifunc' => 'content_55eadc8443d3e1_02808891',
  'has_nocache_code' => false,
  'cache_lifetime' => 3600,
),true);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_55eadc8443d3e1_02808891')) {
function content_55eadc8443d3e1_02808891 ($_smarty_tpl) {
?>

<!DOCTYPE html>
<html>
<head>
	<title>HenrikBN.dk</title>
	<meta charset="utf-8">
	<link href="http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700" rel="stylesheet" type="text/css">
	<link href='http://fonts.googleapis.com/css?family=Source+Code+Pro:400,700' rel='stylesheet' type='text/css'>
	<link href="../../../styles/default.css" rel="stylesheet" type="text/css">
	<link href="../../../styles/navigation.css" rel="stylesheet" type="text/css">
	<link href="../../../styles/articles.css" rel="stylesheet" type="text/css">
	<script src="../../../scripts/jquery-2.1.4.js" type="text/javascript"></script>
	<script src="../../../scripts/jquery.snippet.js" type="text/javascript"></script>
	<script src="../../../scripts/scripts.js" type="text/javascript"></script>
</head>
<body>
<div id="wrapper">
	
	<div id="header">
		<h1>HenrikBN.dk</h1>
		<div id="navigation-bar">
			
			<ul id="navigation">
				<li><a href="http://localhost/testapp/">Home</a></li>
				<li><a href="http://localhost/testapp/articles/2015-07-18/This-is-an-article/">Article</a></li>
				<li><a href="http://localhost/testapp/">Herp</a></li>
				<li><a href="http://localhost/testapp/">Derp</a></li>
			</ul>
		</div>
	</div>
		
	<h2>This Is An Article</h2>
	<p class="subtitle">Published by Henrik B. Nørgaard at 2015-07-18 01:12.</p>
	<p>This is the content of the website.</p><pre class="js"><code>// http://www.steamdev.com/snippet/

$(document).ready(function()
{
	$("pre.html").snippet("html");
	$("pre.css").snippet("css", {style: "peachpuff"});
	$("pre.js").snippet("javascript", {style: "peachpuff"});
});</code></pre><pre class="cppColl"><code>package com.frazers.android_whist_assignment2.model;

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
        if (name.equals(""))
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
}</code></pre><p>And so is this. And oh look, a <a href="index.php">link</a>.</p>
	
	
	<div id="footer">
		Henrik B. Nørgaard &lt;kontakt@henrikbn.dk&gt;
	</div>
</div>
</body>
</html><?php }
}
?>