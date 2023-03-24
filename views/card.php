

    <section class="dark change">
    
        <div class="container py-4">
            <!-- <h1 class="h1 text-center" id="pageHeaderTitle">My Cards Dark</h1> -->
    
            <article class="postcard dark blue">
                <a class="postcard__img_link" href="#">
                    <img class="postcard__img" src="https://picsum.photos/1000/1000" alt="Image Title" />
                </a>
                <div class="postcard__text">
                    <h1 class="postcard__title blue"><a href="#">Product Title</a></h1>
                    <div class="postcard__subtitle small">

                    <i class="fas fa-calendar-alt mr-2"></i>in Stock!
                </div>
                <div class="postcard__bar" ></div>
                <h5 class="postcard__title blue" ><a href="#"><i class="fa fa-inr" aria-hidden="true"></i> 8,000</a></h5>
                <div class="postcard__preview-txt"></div>
                    <ul class="postcard__tagbox">
                        <?php 
                            if($IsAdmin == true){
                                echo " <li class='tag__item'>Delete</li>
                                <li class='tag__item editProduct'><i class='fas fa-clock mr-2 '></i>Edit</li>";
                            }
                        ?>
                        <li class="tag__item play blue">
                            <!-- <a href="#">5 <i class="fa fa-star" aria-hidden="true" style="color:yellow;"></i></a> -->
                            <a href="#">cart</a>
                        </li>
                    </ul>
                </div>
            </article>
            <article class="postcard dark red">
                <a class="postcard__img_link" href="#">
                    <img class="postcard__img" src="https://picsum.photos/501/500" alt="Image Title" />	
                </a>
                <div class="postcard__text">
                    <h1 class="postcard__title red"><a href="#">Podcast Title</a></h1>
                    <div class="postcard__subtitle small">
                        <time datetime="2020-05-25 12:00:00">
                            <i class="fas fa-calendar-alt mr-2"></i>
                        </time>
                    </div>
                    <div class="postcard__bar"></div>
                    <h4 class="postcard__title blue" ><a href="#"><i class="fa fa-inr" aria-hidden="true"></i> 8,000</a></h4>
                    <div class="postcard__preview-txt">i, illum quos!</div>
                    <ul class="postcard__tagbox">
                    <?php 
                            if($IsAdmin == true){
                                echo " <li class='tag__item'>Delete</li>
                                <li class='tag__item editProduct'><i class='fas fa-clock mr-2 '></i>Edit</li>";
                            }
                        ?>
                        <li class="tag__item play blue">
                            <a href="#">5 <i class="fa fa-star" aria-hidden="true" style="color:yellow;"></i></a>
                        </li>
                    </ul>
                </div>
            </article>
            <article class="postcard dark green">
                <a class="postcard__img_link" href="#">
                    <img class="postcard__img" src="https://picsum.photos/500/501" alt="Image Title" />
                </a>
                <div class="postcard__text">
                    <h1 class="postcard__title green"><a href="#">Podcast Title</a></h1>
                    <div class="postcard__subtitle small">
                        <time datetime="2020-05-25 12:00:00">
                            <!-- <i class="fas fa-calendar-alt mr-2"></i>Mon, May 25th 2020 -->
                        </time>
                    </div>
                    <div class="postcard__bar"></div>
                    <h4 class="postcard__title blue" ><a href="#"><i class="fa fa-inr" aria-hidden="true"></i> 5,000</a></h4>
                    <div class="postcard__preview-txt"> quos!</div>
                    <ul class="postcard__tagbox">
                    <?php 
                            if($IsAdmin == true){
                                echo " <li class='tag__item'>Delete</li>
                                <li class='tag__item editProduct'><i class='fas fa-clock mr-2 '></i>Edit</li>";
                            }
                        ?>
                        <li class="tag__item play blue">
                            <a href="#">5 <i class="fa fa-star" aria-hidden="true" style="color:yellow;"></i></a>
                        </li>
                    </ul>
                </div>
            </article>
            <article class="postcard dark yellow">
                <a class="postcard__img_link" href="#">
                    <img class="postcard__img" src="https://picsum.photos/501/501" alt="Image Title" />
                </a>
                <div class="postcard__text">
                    <h1 class="postcard__title yellow"><a href="#">Podcast Title</a></h1>
                    <div class="postcard__subtitle small">
                        <time datetime="2020-05-25 12:00:00">
                            <!-- <i class="fas fa-calendar-alt mr-2"></i>Mon, May 25th 2020 -->
                        </time>
                    </div>
                    <div class="postcard__bar"></div>
                    <h4 class="postcard__title blue" ><a href="#"><i class="fa fa-inr" aria-hidden="true"></i> 10,000</a></h4>
                    <div class="postcard__preview-txt">Lorem ipsum dolor illum quos!</div>
                    <ul class="postcard__tagbox">
                    <?php 
                            if($IsAdmin == true){
                                echo " <li class='tag__item'>Delete</li>
                                <li class='tag__item editProduct'><i class='fas fa-clock mr-2 '></i>Edit</li>";
                            }
                        ?>
                        <li class="tag__item play blue">
                            <a href="#">5 <i class="fa fa-star" aria-hidden="true" style="color:yellow;"></i></a>
                        </li>
                    </ul>
                    <div>
                        <input type="submit" name="addtocart" value="Add to Cart">
                    </div>
                </div>
            </article>
        </div>
    </section>
    
    <!-- <section class="light">
        <div class="container py-2">
            <div class="h1 text-center text-dark" id="pageHeaderTitle">My Cards Light</div>
    
            <article class="postcard light blue">
                <a class="postcard__img_link" href="#">
                    <img class="postcard__img" src="https://picsum.photos/1000/1000" alt="Image Title" />
                </a>
                <div class="postcard__text t-dark">
                    <h1 class="postcard__title blue"><a href="#">Podcast Title</a></h1>
                    <div class="postcard__subtitle small">
                        <time datetime="2020-05-25 12:00:00">
                            <i class="fas fa-calendar-alt mr-2"></i>Mon, May 25th 2020
                        </time>
                    </div>
                    <div class="postcard__bar"></div>
                    <div class="postcard__preview-txt">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi, fugiat asperiores inventore beatae accusamus odit minima enim, commodi quia, doloribus eius! Ducimus nemo accusantium maiores velit corrupti tempora reiciendis molestiae repellat vero. Eveniet ipsam adipisci illo iusto quibusdam, sunt neque nulla unde ipsum dolores nobis enim quidem excepturi, illum quos!</div>
                    <ul class="postcard__tagbox">
                        <li class="tag__item"><i class="fas fa-tag mr-2"></i>Podcast</li>
                        <li class="tag__item"><i class="fas fa-clock mr-2"></i>55 mins.</li>
                        <li class="tag__item play blue">
                            <a href="#"><i class="fas fa-play mr-2"></i>Play Episode</a>
                        </li>
                    </ul>
                </div>
            </article>
            <article class="postcard light red">
                <a class="postcard__img_link" href="#">
                    <img class="postcard__img" src="https://picsum.photos/501/500" alt="Image Title" />	
                </a>
                <div class="postcard__text t-dark">
                    <h1 class="postcard__title red"><a href="#">Podcast Title</a></h1>
                    <div class="postcard__subtitle small">
                        <time datetime="2020-05-25 12:00:00">
                            <i class="fas fa-calendar-alt mr-2"></i>Mon, May 25th 2020
                        </time>
                    </div>
                    <div class="postcard__bar"></div>
                    <div class="postcard__preview-txt">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi, fugiat asperiores inventore beatae accusamus odit minima enim, commodi quia, doloribus eius! Ducimus nemo accusantium maiores velit corrupti tempora reiciendis molestiae repellat vero. Eveniet ipsam adipisci illo iusto quibusdam, sunt neque nulla unde ipsum dolores nobis enim quidem excepturi, illum quos!</div>
                    <ul class="postcard__tagbox">
                        <li class="tag__item"><i class="fas fa-tag mr-2"></i>Podcast</li>
                        <li class="tag__item"><i class="fas fa-clock mr-2"></i>55 mins.</li>
                        <li class="tag__item play red">
                            <a href="#"><i class="fas fa-play mr-2"></i>Play Episode</a>
                        </li>
                    </ul>
                </div>
            </article>
            <article class="postcard light green">
                <a class="postcard__img_link" href="#">
                    <img class="postcard__img" src="https://picsum.photos/500/501" alt="Image Title" />
                </a>
                <div class="postcard__text t-dark">
                    <h1 class="postcard__title green"><a href="#">Podcast Title</a></h1>
                    <div class="postcard__subtitle small">
                        <time datetime="2020-05-25 12:00:00">
                            <i class="fas fa-calendar-alt mr-2"></i>Mon, May 25th 2020
                        </time>
                    </div>
                    <div class="postcard__bar"></div>
                    <div class="postcard__preview-txt">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi, fugiat asperiores inventore beatae accusamus odit minima enim, commodi quia, doloribus eius! Ducimus nemo accusantium maiores velit corrupti tempora reiciendis molestiae repellat vero. Eveniet ipsam adipisci illo iusto quibusdam, sunt neque nulla unde ipsum dolores nobis enim quidem excepturi, illum quos!</div>
                    <ul class="postcard__tagbox">
                        <li class="tag__item"><i class="fas fa-tag mr-2"></i>Podcast</li>
                        <li class="tag__item"><i class="fas fa-clock mr-2"></i>55 mins.</li>
                        <li class="tag__item play green">
                            <a href="#"><i class="fas fa-play mr-2"></i>Play Episode</a>
                        </li>
                    </ul>
                </div>
            </article>
            <article class="postcard light yellow">
                <a class="postcard__img_link" href="#">
                    <img class="postcard__img" src="https://picsum.photos/501/501" alt="Image Title" />
                </a>
                <div class="postcard__text t-dark">
                    <h1 class="postcard__title yellow"><a href="#">Podcast Title</a></h1>
                    <div class="postcard__subtitle small">
                        <time datetime="2020-05-25 12:00:00">
                            <i class="fas fa-calendar-alt mr-2"></i>Mon, May 25th 2020
                        </time>
                    </div>
                    <div class="postcard__bar"></div>
                    <div class="postcard__preview-txt">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi, fugiat asperiores inventore beatae accusamus odit minima enim, commodi quia, doloribus eius! Ducimus nemo accusantium maiores velit corrupti tempora reiciendis molestiae repellat vero. Eveniet ipsam adipisci illo iusto quibusdam, sunt neque nulla unde ipsum dolores nobis enim quidem excepturi, illum quos!</div>
                    <ul class="postcard__tagbox">
                        <li class="tag__item"><i class="fas fa-tag mr-2"></i>Podcast</li>
                        <li class="tag__item"><i class="fas fa-clock mr-2"></i>55 mins.</li>
                        <li class="tag__item play yellow">
                            <a href="#"><i class="fas fa-play mr-2"></i>Play Episode</a>
                        </li>
                    </ul>
                </div>
            </article>
        </div>
    </section> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

