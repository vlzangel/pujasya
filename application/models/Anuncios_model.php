<?php

class Anuncios_model extends CI_Model {

    private $table = 'vv_anuncios';

    function __construct() {
        parent::__construct();
    }

    function get_all($condition)
    {
        $this->db->select('a.*,u.name as usuario, c.name as categoria,u.seo as seo_user,u.mostrar_perfil,u.premium,
        (SELECT name FROM vv_img_anuncios as img WHERE img.anuncio_id = a.id_anuncio AND img.order = 1) as imagen');
        $this->db->from($this->table.' as a');
        $this->db->join('vv_categorias as c','c.id_categoria = a.categoria_id','left');
        $this->db->join('vv_users as u','u.id_user = a.user_id','left');
        $this->db->where($condition);
        $this->db->order_by('id_anuncio','RAND');
        $query = $this->db->get();

        return ($query)?$query->result_array():false;
    }

    function get_all_relacionados($condition)
    {
        $this->db->select('a.*,u.name as usuario,u.nickname, c.name as categoria,u.seo as seo_user,u.mostrar_perfil,
        (SELECT name FROM vv_img_anuncios as img WHERE img.anuncio_id = a.id_anuncio AND img.order = 1) as imagen');
        $this->db->from($this->table.' as a');
        $this->db->join('vv_categorias as c','c.id_categoria = a.categoria_id','left');
        $this->db->join('vv_users as u','u.id_user = a.user_id','left');
        $this->db->where($condition);
        $this->db->limit(15,0);
        $this->db->order_by('u.premium','RAND');
        $query = $this->db->get();

        return ($query)?$query->result_array():false;
    }

    function get_all_favoritos($condition)
    {
        $this->db->select('a.*,u.name as usuario, c.name as categoria,u.seo as seo_user,u.mostrar_perfil,
        (SELECT name FROM vv_img_anuncios as img WHERE img.anuncio_id = a.id_anuncio AND img.order = 1) as imagen');
        $this->db->from($this->table.' as a');
        $this->db->join('vv_categorias as c','c.id_categoria = a.categoria_id','left');
        $this->db->join('vv_users as u','u.id_user = a.user_id','left');
        $this->db->where($condition);
        $this->db->order_by('id_anuncio','desc');
        $query = $this->db->get();

        return ($query)?$query->result_array():false;
    }

    function get_by($condition)
    {
        $this->db->select('a.*,u.name as usuario,u.nickname, u.seo as seo_user,u.mostrar_perfil,l.localidad as ciudad,u.imagen as img_perfil,u.premium,p.provincia,u.mostrar_email,u.email,u.telefono_fijo,u.telefono_movil,
        vv_marcas.name as marca,c.name as categoria,c.seo as cat_seo,sc.name as subcategoria, sc.seo as subcat_seo');
        $this->db->from($this->table.' as a');
        $this->db->join('vv_categorias as c','c.id_categoria = a.categoria_id','left');
        $this->db->join('vv_subcategorias as sc','sc.id_subcategoria = a.subcategoria_id','left');
        $this->db->join('vv_users as u','u.id_user = a.user_id','left');
        $this->db->join('provincias as p','p.id = u.provincia_id','left');
        $this->db->join('localidades as l','l.id = u.poblacion_id','left');
        $this->db->join('vv_marcas','vv_marcas.id_marca = a.marca_id','left');
        $this->db->where($condition);
        $query = $this->db->get();

        return ($query)?$query->row_array():false;
    }

    function save($data = array(),$imagenes = array())
    {
        //BEGIN TRANSACTION

        $this->db->trans_start();

        //$this->db->trans_begin();

        //Insertar en tabla de anuncios

        $this->db->insert($this->table, $data);

        $id = $this->db->insert_id();

        //insertar imagenes

        $cantImg = count($imagenes);

        if($cantImg > 0)
        {
            $feat = 1;

            for ($i=0; $i < $cantImg; $i++) 
            { 
               $imagen = array('anuncio_id' => $id, 'name_thumb' => $imagenes[$i], 'name' => $imagenes[$i], 'order' => $feat);

               $this->db->insert('vv_img_anuncios', $imagen);

               $feat = 0;
            }
        }

        //END OF TRANSACTION

        $this->db->trans_complete();

        //VALIDATE TRANSACTION

        return $this->db->trans_status() === FALSE?false:$id; 
    }

    function edit($data = array(),$imagenes = array(),$id)
    {
        //BEGIN TRANSACTION

        $this->db->trans_start();

        //$this->db->trans_begin();

        //Editar en tabla de anuncios

        $this->db->where('id_anuncio',$id);

        $this->db->update($this->table, $data);

        //insertar imagenes

        $cantImg = count($imagenes);

        if($cantImg > 0)
        {
            $order = applib::get_field(applib::$img_table,array('anuncio_id' => $id,'order' => 1),'id_imagen');

            $feat = $order != ""?'0':1;

            for ($i=0; $i < $cantImg; $i++) 
            { 
               $imagen = array('anuncio_id' => $id, 'name_thumb' => $imagenes[$i], 'name' => $imagenes[$i], 'order' => $feat);

               $this->db->insert('vv_img_anuncios', $imagen);

               $feat = 0;
            }
        }

        //END OF TRANSACTION

        $this->db->trans_complete();

        //VALIDATE TRANSACTION

        return $this->db->trans_status() === FALSE?false:true; 
    }


    function get_all_listado($condition,$paginas,$order_by = NULL)
    {
        $this->db->select('a.*,u.name as usuario,u.nickname, c.name as categoria,
            u.seo as seo_user,u.mostrar_perfil,l.localidad as ciudad,u.imagen as img_perfil,u.premium,p.provincia,u.mostrar_email,u.email,u.telefono_fijo,
            u.telefono_movil,u.poblacion_id as ciudad_user,u.provincia_id as provincia_user,
        (SELECT name FROM vv_img_anuncios as img WHERE img.anuncio_id = a.id_anuncio AND img.order = 1) as imagen');
        $this->db->from($this->table.' as a');
        $this->db->join('vv_categorias as c','c.id_categoria = a.categoria_id','left');
        $this->db->join('vv_subcategorias as s','s.id_subcategoria = a.subcategoria_id','left');
        $this->db->join('vv_users as u','u.id_user = a.user_id','left');
        $this->db->join('localidades as l','l.id = u.poblacion_id','left');
        $this->db->join('provincias as p','p.id = u.provincia_id','left');
        $this->db->where($condition);
        $this->db->limit($paginas['porpagina'],$paginas['pagina']);
        $this->db->order_by($order_by);
        $query = $this->db->get();

        return ($query)?$query->result_array():false;
    }

    function get_count_listado($condition)
    {
        $this->db->select('a.*,u.name as usuario,u.nickname, c.name as categoria,u.mostrar_perfil,l.localidad as ciudad,u.premium,u.poblacion_id as ciudad_user,u.provincia_id as provincia_user');
        $this->db->from($this->table.' as a');
        $this->db->join('vv_categorias as c','c.id_categoria = a.categoria_id','left');
        $this->db->join('vv_subcategorias as s','s.id_subcategoria = a.subcategoria_id','left');
        $this->db->join('vv_users as u','u.id_user = a.user_id','left');
        $this->db->join('localidades as l','l.id = u.poblacion_id','left');
        $this->db->where($condition);
        $query = $this->db->get();

        return ($query)?$query->num_rows():0;
    }

    function get_all_cuantos($condition)
    {
        $this->db->select('a.*,u.name as usuario,u.nickname, c.name as categoria,u.mostrar_perfil,l.localidad as ciudad,u.premium,u.poblacion_id as ciudad_user,u.provincia_id as provincia_user');
        $this->db->from($this->table.' as a');
        $this->db->join('vv_categorias as c','c.id_categoria = a.categoria_id','left');
        $this->db->join('vv_subcategorias as s','s.id_subcategoria = a.subcategoria_id','left');
        $this->db->join('vv_users as u','u.id_user = a.user_id','left');
        $this->db->join('localidades as l','l.id = u.poblacion_id','left');
        $this->db->where($condition);
        $query = $this->db->get();

        return ($query)?$query->result_array():0;
    }

    function get_all_premium($condition,$order_by = NULL)
    {
        $this->db->select('a.*,u.name as usuario, u.nickname, c.name as categoria,u.seo as seo_user,u.mostrar_perfil,l.localidad as ciudad,u.imagen as img_perfil,u.premium,u.poblacion_id as ciudad_user,u.provincia_id as provincia_user,
        (SELECT name FROM vv_img_anuncios as img WHERE img.anuncio_id = a.id_anuncio AND img.order = 1) as imagen');
        $this->db->from($this->table.' as a');
        $this->db->join('vv_categorias as c','c.id_categoria = a.categoria_id','left');
        $this->db->join('vv_subcategorias as s','s.id_subcategoria = a.subcategoria_id','left');
        $this->db->join('vv_users as u','u.id_user = a.user_id','left');
        $this->db->join('localidades as l','l.id = u.poblacion_id','left');
        $this->db->where($condition);
        $this->db->order_by($order_by);
        $query = $this->db->get();

        return ($query)?$query->result_array():false;
    }

    function get_suma_visitas($condition)
    {
        $this->db->select('(SELECT SUM(a.visitas) FROM '.$this->table.' as a WHERE a.user_id = u.id_user AND a.status = 1)  as total');
        $this->db->from($this->table.' as a');
        $this->db->join('vv_users as u','u.id_user = a.user_id','left');
        $this->db->where($condition);
        $query = $this->db->get();

        return ($query)?$query->row_array():false;
    }

    function get_mas_visitados($condition,$paginas,$order_by = NULL)
    {
        $this->db->select('a.*,
        (SELECT name FROM vv_img_anuncios as img WHERE img.anuncio_id = a.id_anuncio AND img.order = 1) as imagen');
        $this->db->from($this->table.' as a');
        $this->db->join('vv_categorias as c','c.id_categoria = a.categoria_id','left');
        $this->db->join('vv_subcategorias as s','s.id_subcategoria = a.subcategoria_id','left');
        $this->db->join('vv_users as u','u.id_user = a.user_id','left');
        $this->db->join('localidades as l','l.id = u.poblacion_id','left');
        $this->db->where($condition);
        $this->db->limit($paginas['porpagina'],$paginas['pagina']);
        $this->db->order_by($order_by);
        $query = $this->db->get();

        return ($query)?$query->result_array():false;
    }


}