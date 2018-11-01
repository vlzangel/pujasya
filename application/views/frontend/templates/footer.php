<section class="footer-top-area pt-70 mt-30 pb-30 pos-r bg-blue">
            <div class="container">
                <div class="row row-tb-20">
                    <div class="col-sm-12 col-md-7">
                        <div class="row row-tb-20">
                            <div class="footer-col col-sm-6">
                                <div class="footer-about">
                                    <img class="mb-10" src="<?= base_url()?>public/assets/images/pujasya.png" width="250" alt="">
                                    <p class="color-light">pujasya.com es una plataforma online GRATIS. Se caracteriza por la rapidez, sencillez y diseño, donde pujar ahora es más fácil.</p>
                                </div>
                            </div>
                            <div class="footer-col col-sm-6">
                                <div class="footer-links">
                                    <h2 class="color-lighter">Sobre Nosotros</h2>
                                    <ul>
                                    <li><a href="javascript:;" onclick="modal_premium()">¿Cómo Funciona?</a>
                                        </li>
                                        <li><a href="<?= base_url('terminos_y_condiciones')?>">Términos y Condiciones</a>
                                        <li><a href="<?= base_url('preguntas_frecuentes')?>">Preguntas Frecuentes</a>
                                        </li>
                                        <li><a href="<?= base_url('contacta')?>">Contacta</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-5">
                        <div class="row row-tb-20">
                            <div class="footer-col col-sm-6">
                                <div class="footer-links">
                                    <h2 class="color-lighter">Accesos Rápidos</h2>
                                    <ul>
                                         <?php if($this->session->userdata('user_id') == ""):?>
                                            <li><a href="<?= base_url('ingresar')?>">Entrar</a>
                                            </li>
                                            <li><a href="<?= base_url('registro')?>">Registrarse</a>
                                            </li>
                                        <?php else: ?>
                                            <li><a href="<?= base_url('perfil')?>">Mi Cuenta</a>
                                            </li>
                                             <li><a href="<?= base_url('ingresar/salir')?>">Salir</a></li> 
                                        <?php endif ?>
                                    </ul>

                                </div>
                            </div>
                            <div class="footer-col col-sm-6">
                             <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fjbosolutions%2F&tabs=timeline&width=280&height=100&small_header=false&adapt_container_width=false&hide_cover=false&show_facepile=false&appId=686287144729144" width="340" height="150" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </section>

        <footer id="mainFooter" class="main-footer">
            <div class="container">
                <div class="row">
                    <p>Copyright &copy; 2018 PujasYA. Derechos Reservados. Soporte y Ventas: hola@pujasya.com</p>
                </div>
            </div>
        </footer>


    </div>
    <div id="backTop" class="back-top is-hidden-sm-down">
        <i class="fa fa-angle-up" aria-hidden="true"></i>
    </div>

    <script src="<?= base_url()?>public/assets/js/bootstrap.min.js"></script>

    <script src="<?= base_url()?>public/assets/vendors/modernizr/modernizr-2.6.2.min.js"></script>
    
    <!-- Owl Carousel -->
    <script src="<?= base_url()?>public/assets/vendors/owl-carousel/owl.carousel.min.js"></script>

    <!-- FlexSlider -->
    <script src="<?= base_url()?>public/assets/vendors/flexslider/jquery.flexslider-min.js"></script>

    <!-- Coutdown -->
    <script src="<?= base_url()?>public/assets/vendors/countdown/jquery.countdown.js"></script>

    <script src="<?= base_url()?>public/assets/js/main.js"></script>

    <script>var base_url = "<?= base_url()?>";</script>

    <script>var contenido = "<?= $contenido?>";</script>

    <script>var metodo = "<?= $this->uri->segment(2)?>";</script>

    <script src="<?=base_url()?>public/assets/js/functions.js?v=<?=time()?>"></script>

</body>
<script>
  // google analystics

</script>

</html>

