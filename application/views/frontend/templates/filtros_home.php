<div class="row" style="display: flex;align-items: center;">
    <div class="col-md-8">
        <span class="list-control-view"> <?php 
            if(isset($anuncios_usuario)): ?>
                Anuncios de <?= $premium[0]['usuario'] ?> 
                <?= $premium[0]['premium'] == 1?' | <i class="fa fa-bullseye" style="margin-right: 6px;"></i>PREMIUM': '';
            else: $status_show = ( isset($status) ) ? $status: 1; ?>
                <a class="btn btn-primary ocultar2 btn-activos <?= ($status_show == "activa") ? 'btn-seleted': ''; ?>" href="<?= base_url()?>search/<?= $way_of_showing ?>/activa/<?= $orderBy+0 ?>">pujas en vivo</a>
                <a class="btn btn-primary ocultar2 btn-activos <?= ($status_show == "proximas") ? 'btn-seleted': ''; ?>" href="<?= base_url()?>search/<?= $way_of_showing ?>/proximas/<?= $orderBy+0 ?>">próximas pujas</a>
                <a class="btn btn-primary ocultar2 btn-activos <?= ($status_show == "cerrada") ? 'btn-seleted': ''; ?>" href="<?= base_url()?>search/<?= $way_of_showing ?>/cerrada/<?= $orderBy+0 ?>">pujas cerradas</a> <?php
                if( $this->session->userdata('user_id') == "" ){ ?>
                    <a class="btn btn-primary ocultar2 btn-inactivos" href="#" >pujas favoritas</a>
                    <a class="btn btn-primary ocultar2 btn-inactivos" href="#" >pujas ganadas</a> <?php
                }else{ ?>
                    <a class="btn btn-primary ocultar2 btn-activos <?= ($status_show == "favoritos") ? 'btn-seleted': ''; ?>" href="<?= base_url()?>search/<?= $way_of_showing ?>/favoritos/<?= $orderBy+0 ?>" >pujas favoritas</a>
                    <a class="btn btn-primary ocultar2 btn-activos <?= ($status_show == "ganada") ? 'btn-seleted': ''; ?>" href="<?= base_url()?>search/<?= $way_of_showing ?>/ganada/<?= $orderBy+0 ?>" >pujas ganadas</a> <?php
                } ?>
                <!-- <a class="btn btn-primary ocultar2" href="/#" style="padding: 3px 5px !important; height: 28px; font-size: 12px;  margin-top: -2px; text-transform: inherit; letter-spacing: 0px; font-weight: 600; background: #d0d0d0 !important; color: black; border: 1px solid #a0a0a0;">shop</a> --><?php 
            endif ?>
        </span>
    </div>
    <div class="col-md-2 text-right pr-0">
        <a class="btn btn-primary ocultar2 <?= $way_of_showing == "grid" ? 'btn-seleted':'' ?>" href="<?= base_url() ?>search/grid/<?= $status_show; ?>/<?= $orderBy; ?>" style="padding: 3px 5px !important;height: 32px;font-size: 12px;text-transform: inherit;letter-spacing: 0px;font-weight: 600;background: #d0d0d0;color: black;border: 1px solid #a0a0a0;display: inline-block;">
            <i class="fa fa-columns" style="font-size: 25px;"></i>
        </a>
        <a class="btn btn-primary ocultar2 <?= $way_of_showing == "list" ? 'btn-seleted':'' ?>" href="<?= base_url() ?>search/list/<?= $status_show; ?>/<?= $orderBy; ?>" style="padding: 3px 5px !important;height: 32px;font-size: 12px;text-transform: inherit;letter-spacing: 0px;font-weight: 600;background: #d0d0d0;color: black;border: 1px solid #a0a0a0;display: inline-block;">
            <i style="font-size: 25px;" class="fa fa-list"></i>
        </a>
    </div>
    <div class="col-md-2 col-sm-12 col-xs-12">
        <select class="form-control input-sm" id="ordenar_por_filter" style="max-width:180px;float: right;">
            <option value="<?= base_url() ?>search/grid/<?= $status_show; ?>" <?= $orderBy+0 == 0 ?'selected':'' ?> >Ordenar por</option>
            <option value="<?= base_url() ?>search/grid/<?= $status_show; ?>/1" <?= $orderBy == 1 ?'selected':''?> > Últimos</option>
            <option value="<?= base_url() ?>search/grid/<?= $status_show; ?>/2" <?= $orderBy == 2 ?'selected':''?> > Precio: Menor a Mayor</option>
            <option value="<?= base_url() ?>search/grid/<?= $status_show; ?>/3" <?= $orderBy == 3 ?'selected':''?> > Precio: Mayor a Menor</option>
        </select>
    </div>
</div>
<div class="row">
    <div class="col-md-12" style="padding-top: 10px;">
        <?= $this->session->flashdata('msg')?>
    </div>
</div>