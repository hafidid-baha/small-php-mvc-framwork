<!--header start-->
        <header>
            <div class="languageContoler">
                <a href="/mvcFramwork/public/index/language"><img src="/mvcFramwork/public/images/lang.png" /> 
                    <?php 
                        if(isset($_SESSION['lang'])){
                            if($_SESSION['lang'] === 'en'){
                                echo 'عربي';
                            }else{
                                echo 'english';
                            }
                        }else{
                            echo DEFAULT_LANG;
                        }
                    ?>
                </a>
            </div>
        </header>
        <!--header end-->