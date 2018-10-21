<div class="col-md-12 splr hidden-xs">
    <div class="row panel ptb-10 mtb-30 slmr0">
        <div class="col-md-6">
            <h4 class="mt-3">Nuevos Usuarios</h4>
        </div>
        <div class="col-md-6 text-right">
            <a href="<?= $this->session->userdata('user_id') == ""?base_url('ingresar'):base_url('perfil')?>" class="btn btn-o btn-xs">Mi Cuenta</a>
        </div>
    </div>
</div>

<div class="col-md-12 mb-30 splr col-md-12 mb-30 splr section stores-area stores-area-v1 hidden-xs">
    <div class="popular-stores-slider owl-slider" data-loop="true" data-autoplay="true" data-smart-speed="500" data-autoplay-timeout="5000" data-margin="20" data-items="2" data-xxs-items="2" data-xs-items="2" data-sm-items="3" data-md-items="5" data-lg-items="6"> <?php 
        if(count($users) > 0): 
            foreach ($users as $u): ?>
                <div class="store-item t-center">
                    <div class="panel is-block">
                        <div class="embed-responsive embed-responsive-4by3">
                            <div class="store-logo">
                                <?php $imagen = $u['imagen'] == NULL?'no-image.jpg':$u['imagen']?>
                                <img src="<?= base_url()?>public/uploads/avatars/<?= $imagen?>" alt="">
                            </div>
                        </div>
                        <h6 class="store-name ptb-10"><?= applib::titulo($u['name'])?></h6>
                    </div>
                </div> <?php 
            endforeach; 
        endif ?>
    </div>
</div>