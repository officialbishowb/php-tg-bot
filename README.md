# Php-Bot
A simple PHP code which is designed to work as a Bot manager

<h1>Php Telegram Bot manager</h1>

<h2>This Php code is designed to manage a simple Telegram Bot</h2>
<h3>It has also some extra function for people who do <b>Giveaway</b> in Telegram</h3>
<h3>Commands that are avaiable for normal user</h3>
  <ul>
    <li>/info -> gives user stat</li>
    <li>/mynotes -> can save notes</li>
    <li><b>/stop</b> -> stops the bot-no need to block</li>
  </ul>
<h3>Commands that are avaiable for owner</h3>
  <ul>
    <li>/ban -> can ban a user</li>
    <li>/unban -> can unban a user</li>
    <li>/lock -> will lock the bot no msg will be forwared</li>
    <li>/unlock -> will unlock the bot</li>
    <li>/code -> add a giveaway code will be used as detection (extra feature)</li>
    <li>/giveaway ->when <i>true</i> then only code that is a giveaway code will be forwared (extra feature)</li>
   <li>/brodcast ->is used for broadcasting to all bot user BUT this is currently not working</li>
  </ul>
  
  <h3>How to use this?</h3>
<ol>
  <li>Enter your API Token in the bot.php file</li>
  <li>Setup the webhook by https://api.telegram.org/bot.$botToken./setwebhook?url=url. For <b>url</b> use your hosting site url which redirects to the bot.php file </li>
  </ol>
  <p>After that the bot should start working</p>
  
  <h3>NOTE: This BOT is not yet used as it has some missing function</h3>
  <ol>
  <li>For Admin -> Reply to sender message</li>
  <li>For Admin -> Broadcast a message to all user in the bot. PHP dont work well</li>
  </ol>

  
    

<p>Orignal creator: <a href="https://t.me/beanonymousofficial">Bishow Bhattarai</a></p>
