<!--Footer-->
<footer class="bg-light text-lg-start">
  

        <hr class="m-0" />

        <div class="text-center py-4 align-items-center">
            <p>Follow us on social media</p>
            <a href="<?php echo getWebsiteData()['twitter_link'];?>" class="btn btn-primary m-1" role="button" rel="nofollow" target="_blank">
                <i class="fab fa-twitter"></i>
            <a href="<?php echo getWebsiteData()['youtube_link'];?>" class="btn btn-primary m-1" role="button" rel="nofollow" target="_blank">
                <i class="fab fa-youtube"></i>
            </a>
            <a href="<?php echo getWebsiteData()['facebook_link'];?>" class="btn btn-primary m-1" role="button" rel="nofollow" target="_blank">
                <i class="fab fa-facebook-f"></i>
            </a>            
            </a>
            <a href="https://github.com/researchcode/linkedatlas" class="btn btn-primary m-1" role="button" rel="nofollow" target="_blank">
                <i class="fab fa-github"></i>
            </a>
        </div>

        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        <?php echo getWebsiteData()['copyright'];?>
        </div>
        <!-- Copyright -->
    </footer>
    <!--Footer-->
<!-- MDB -->
<script type="text/javascript" src="<?php echo JS_PATH;?>mdb.min.js"></script>
<script type="text/javascript" src="<?php echo JS_PATH;?>bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>