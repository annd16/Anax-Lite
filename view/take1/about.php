    </div>
    <main>
        <article>
            <header>
                <h3> About </h3>
                <p class="author">Uppdated <time datetime="2017-06-05 22:05:37">the 5th of June 2017</time> by Anna</p>
            </header>
                <div class="about-div">
                    <p>

                        <img src="img/php-med-trans.png" class="about-img" alt="PHP logo">
                        The dbwebb programming course <a href="https://dbwebb.se/oophp">oophp</a>,
                        gives an introduction to classes and objects in PHP and how object oriented programming could be used to build
                        frameworks for web sites. In this course the PHP Data objects (PDO) extension and database-specific
                        PDO drivers will be used to work against a database.
                        <br/><br/>

                        <a href="http://www.student.bth.se/~annd16/dbwebb-kurser/oophp/me/kmom01/guess/index.php">Guess my number</a><br/>
                        <a href="https://github.com/annd16/Anax-Lite">My Anax-Lite Github repo</a>
                        <br/>
                        <?php $urlStatus = $app->url->create("status"); ?> <a href="<?= $urlStatus ?>">System status</a><br/>

                        <br/><br/>

                        <h3>kmom01</h3>
                        By creating a "Guess my number" game in four different variants, I have in this kmom both refreshened my knowledge in php
                        aquired in an earlier course (including submitting html forms using different http request methods and storing data in php sessions)
                        - and started to use classes and objects in php. I have also (with the aid of a dbwebb article and reusing some existing classes) created
                        my own microframe work ("Anax-Lite"). This web site has been built within this framework.
                        <br/><br/>

                        <h3>kmom02</h3>
                        In this kmom I have created a so called wrapper-class for handling php sessions and the $_SESSION varíable. I have learnt how to
                        integrate a class into the anax-lite frame work, how to use interfaces and traits and how to "inject" dependencies to other classes into the class, via
                        different approaches. I have also learnt how to create web pages by putting 'subviews' together, resembling the regions in Anax-Flat.
                        <br/><br/>



                    </p>
               </div>
        </article>
    </main>
