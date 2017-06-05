<main>

<article class="report">



<header>
<h3>Reports for the different 'kmoms' (in Swedish)</h3>
<p>By Anna</p>
</header>

<section>
<h3>Kmom01</h3>
<p class="question">Hur känns det att hoppa rakt in i klasser med PHP, gick det bra?</p>
Det har känts ganska OK eftersom vi har kommit i kontakt med klasser och objekt tidigare (i oopythonkursen) och
eftersom jag tycker att php är ett språk som är roligt att programmera i.
Började med att göra övningen "Kom igång med oophp20" vilken gav en bra introduktion till klasser och objekt i php.
Den uppgift i detta kursmoment tagit mest tid har varit "Guess my number"-spelet.
Formulär och sessioner har vi också använt tidigare men det var rätt länge sedan,
så det har också vållat mig en del huvudbry. Hade lite problem med att få saker att hända i rätt ordning - dvs hade inte till
att börja med riktigt koll på i vilken ordning koden skulle skrivas. T ex fungerade först inte nedräkningen av antalet gissningar som spelaren har kvar och
det löste sig genom att jag flyttade runt kodblock, men då fick jag istället problem med att det inmatade numret inte 'nollställdes'
mellan postningarna, det löstes också med lite kodblocksomflyttning. Även om det finns en hel del saker kvar att göra på spelet, så är jag ändå ganska nöjd
med resultatet. <br/> Har lagt ner rätt mycket tid på stylingen av spelet (en av extrauppgifterna).

<p class="question">Berätta om dina reflektioner kring ramverk, anax-lite och din me-sida.</p>
Det har varit intressant att bygga upp sitt 'egna' lilla ramverk, om än med lånade klasser/moduler.
Har inte hunnit sätta mig in i ramverkets alla delar ännu men det verkar vara ett bra sätt att bygga upp lite mer professionella
webplatser på, utan att behöva 'uppfinna hjulet på nytt'. Stylingen av sidorna har gjorts i ren CSS, skulle velat styla med LESS
men har inte haft tid till det. Har skapat en (mycket primitiv) byline-vy och en flash-vy (extrauppgift).
Flashbilden syns på alla sidor.<br/>

<p class="question">Gick det bra att komma igång med MySQL, har du liknande erfarenheter sedan tidigare?</p>
Jag har inte hunnit att köra så mycket SQL i detta kursmoment, har endast försökt se till att få labmiljön på
plats (aktiverat min databas på studentservern, installerat workbench etc).
Men eftersom vi i tidigare kurser har använt SQLite, och många kommandon är gemensamma för dessa båda databaser
så ska det förhoppningsvis gå bra. Återkommer i kmom02 eller kmom03 med ett mer utförligt svar på frågan!<br/>

</section>

<section>
<h3>Kmom02</h3>

<p class="question">Hur känns det att skriva kod utanför och inuti ramverket, ser du fördelar och nackdelar med de olika sätten?</p>

Fördelen med att skriva kod inuti ramverket borde ju vara att man får tillgång till dess klasser och metoder, interfaces och traits och slipper skriva allt själv.
Nackdelen är väl det kanske inte alltid är helt lätt att sätta sig in i hur ramverket fungerar, och att det är lite mer uppstyrt vad man kan göra och hur man ska göra det.
Har nog inte utnyttjat ramverket och dess resurser i den omfattning som jag kanske borde gjort än så länge.

<p class="question">Hur väljer du att organisera dina vyer?</p>

Jag har skapat olika underkataloger i vymappen och grupperat vyerna i dessa. De vyer som finns är header, navbar, extra navbar (på sessionssidan), flash, huvudinnehållet,
byline (på me och about-sidan) och så footer (på me-, about- och report-sidan). Eftersom man ska sträva efter att ha så enkla vyer som möjligt har jag försökt att placera så mycket av 'logiken' som möjligt
i mina klasser istället för i vyerna, men i t ex kalendern så finns det förbättringsmöjligheter i det avseendet.

<p class="question">Berätta om hur du löste integreringen av klassen Session.</p>

Routen till huvudsession-sidan lade jag i base-filen, sedan fick de olika undervyerna ligga i en egen route-fil, 'session.php'.
Inkluderade sedan denna fil i route-configfilen 'route.php'. Lade till Sessionsklassen till $app-objektet i frontcontrollern
och skickar med sessionens namn in i konstruktorn. Sessionen startas sedan i en session-configfil som inkluderas i varje sessionsvy.
Sessionsvyerna ligger i en egen underkatalog i vymappen.<br/><br/>

I navbar-fallet testade jag att injicera beroendet av Url- och Requestklassen in i Navbarklassen  på flera olika sätt (enligt alternativ 1-3, i övning 2):
1) låta Navbar-klassen få tillgång till hela $app.
2) injicera endast de delar av Request och Url-klassen som behövs (via två metoder i navbarklassen).
3) injicera beroendena när man genererar menyn.
 <br/>
Fastnade för alternativ 3, dvs jag injicerar de beroenden som finns, i samband med anropet till getHTML(). Nuvarande route och 'url-skaparen' (dvs en array som innehåller
Url-objektet och dess metod 'create') skickas med som inparametrar till getHTML(). Anropet till getHTML() ligger i den routefil som innehåller de routes som använder
sig av navbaren, värdet från den variabel som returneras från metoden skickas med in till vyn när navbarvyn läggs till i de olika sidor som använder sig av navbaren.
I navbar-vyn så finns endast en echo-sats av denna variabel. <br/>
Av ovanstående tre alternativ var det denna lösning som resulterade i minst kod. Enklast hade varit att använda alternativ 1, men de två andra sätten ger (nog) mer inblick
i vad som görs 'bakom kulisserna'. Med alternativ 2, som först kändes som den mest naturliga lösningen blev det av någon anledning mer kod i vyn,
så jag valde bort detta alternativ.

<p class="question">Berätta om hur du löste uppgiften med Tärningsspelet 100/Månadskalendern, hur du tänkte, planerade och utförde uppgiften samt hur du organiserade din kod?</p>

Jag valde att göra månadskalendern eftersom den verkade roligare att göra än tärningspelet och mer användbar.
Jag började med att kolla upp de olika inbyggda klasser/objekt/funktioner som finns i php som hanterar datum och tid. Sedan skapade jag en kalenderklass som först inte innehöll mer än en par "bra-att-ha" funktioner,
som att visa dagens datum, sedan gjorde jag en veckoklass i vars konstruktor det skapas ett intervall med 7st datumtid-objekt.
I en metod i kalender-klassen skapas veckorna som ingår i en viss månadsvy (inkl. ev. dagar i första och sista veckan som inte tillhör månaden).
Lade även in veckonumren (extrauppgift), eftersom jag själv tycker att en kalender inte är komplett utan veckonummer, och för att det verkade vara rätt lätt att genomföra.
När jag väl fått kalendern att fungera började jag flytta över kod från vyn till metoder i kalenderklassen.
 <br/><br/>
Därefter lade jag in namnsdagar i min kalender (extrauppgift), ville testa att i php göra motsvarande det vi gjort i webbappkursen. (Namnsdagarna visas dock endast på enheter med
en skärmbredd större än 400px). Tyvärr visade det sig vid publiceringen att 'curl lib', som jag använt för att hämta hem information, inte går att använda på studentservern så jag fick ladda hem namnsdagarna lokalt
från min dator och spara dem i en fil (och låta kalendern läsa från filen istället). Eftersom namnsdagarna är rätt statiska och normalt inte förändras från ett år till ett annat,
laddade jag bara hem två år, ett vanligt år och ett skottår. Har dock behållit 'curl lib' alternativet för de sevrar som tillåter användning av detta bibliotek, denna lösning känns lite proffsigare.
I det ena fallet hämtas data månadsvis och i det andra fallet för ett helt år, så jag har olika metoder som hanterar de två fallen. Har en metod i kalenderklassen för att markera
aktuella dagen. Har lagt till Namnsdagsklassen till $app-objektet liksom jag tidigare gjort med kalenderklassen.
<br/><br/>
Vid valideringen visade det sig att komplexiteten var för hög i min kalender-klass så då fick jag skapa en till klass, en 'Namnsdagsklass' och föra över tillhörande metoder till denna.
Har använt css vid designen och har försökt använda flex-box: kalendern uppför sig OK för skärmar som är ca 350px eller bredare (i alla fall i x-led, det blir det en del scrollande i y-led
men det får jag fixa till senare). <br/><br/>
Detta har varit en mycket rolig och lärorik uppgift. Har fått hjälp i gitterchatten och i hangout vid ett flertal tillfällen.
 <br/><br/>



<p class="question">Några tankar kring SQL så här långt?</p>

Hitintills så har det inte varit några större problem, förutom att jag först inte förstod hur man skulle göra för att ta bort flera
rader i en tabell, trodde man skulle kunna använda sig av något liknande SELECT *, men det gick ju inte.
Jag ser fram emot att så småningom kunna göra (egna) lite mer avancerade databasprojekt.
<br/><br/>

</section>

<section>
<h3>Kmom03</h3>
<p class="question"></p>

<p class="question"></p>

<p class="question"></p>


</section>

<section>
<h3>Kmom04</h3>
<p>Här är redovisningstexten</p>
</section>

<section>
<h3>Kmom05</h3>
<p>Här är redovisningstexten</p>
</section>

<section>
<h3>Kmom06</h3>
<p>Här är redovisningstexten</p>
</section>

<section>
<h3>Kmom07-10</h3>
<p>Här är redovisningstexten</p>
</section>



</article>

</main>
