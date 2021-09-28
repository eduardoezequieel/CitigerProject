PGDMP     !    $                y            CitigerProject    13.4    13.4 `   �           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            �           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            �           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            �           1262    17496    CitigerProject    DATABASE     r   CREATE DATABASE "CitigerProject" WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE = 'Spanish_El Salvador.1252';
     DROP DATABASE "CitigerProject";
                postgres    false                       1255    17497    sp_historialinventario()    FUNCTION     �   CREATE FUNCTION public.sp_historialinventario() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
BEGIN
INSERT INTO historialInventario(idMaterial, cantidad, fecha) VALUES(old.idMaterial, old.cantidad, current_date);
RETURN NEW;
END
$$;
 /   DROP FUNCTION public.sp_historialinventario();
       public          postgres    false            �            1259    17498    alquiler    TABLE     ^  CREATE TABLE public.alquiler (
    idalquiler integer NOT NULL,
    idestadoalquiler integer NOT NULL,
    idespacio integer NOT NULL,
    precio numeric NOT NULL,
    idusuario integer NOT NULL,
    idresidente integer NOT NULL,
    fecha date NOT NULL,
    horainicio time without time zone NOT NULL,
    horafin time without time zone NOT NULL
);
    DROP TABLE public.alquiler;
       public         heap    postgres    false            �            1259    17504    alquiler_idalquiler_seq    SEQUENCE     �   CREATE SEQUENCE public.alquiler_idalquiler_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 .   DROP SEQUENCE public.alquiler_idalquiler_seq;
       public          postgres    false    200            �           0    0    alquiler_idalquiler_seq    SEQUENCE OWNED BY     S   ALTER SEQUENCE public.alquiler_idalquiler_seq OWNED BY public.alquiler.idalquiler;
          public          postgres    false    201            �            1259    17506 
   aportacion    TABLE       CREATE TABLE public.aportacion (
    idaportacion integer NOT NULL,
    idcasa integer NOT NULL,
    idestadoaportacion integer NOT NULL,
    monto numeric NOT NULL,
    idmespago integer NOT NULL,
    fechapago date NOT NULL,
    descripcion character varying(200) NOT NULL
);
    DROP TABLE public.aportacion;
       public         heap    postgres    false            �            1259    17512    aportacion_idaportacion_seq    SEQUENCE     �   CREATE SEQUENCE public.aportacion_idaportacion_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 2   DROP SEQUENCE public.aportacion_idaportacion_seq;
       public          postgres    false    202            �           0    0    aportacion_idaportacion_seq    SEQUENCE OWNED BY     [   ALTER SEQUENCE public.aportacion_idaportacion_seq OWNED BY public.aportacion.idaportacion;
          public          postgres    false    203            �            1259    17514    bitacora    TABLE       CREATE TABLE public.bitacora (
    idbitacora integer NOT NULL,
    idusuario integer NOT NULL,
    hora time without time zone NOT NULL,
    fecha date NOT NULL,
    accion character varying(20) NOT NULL,
    descripcion character varying(200) NOT NULL
);
    DROP TABLE public.bitacora;
       public         heap    postgres    false            �            1259    17517    bitacora_idbitacora_seq    SEQUENCE     �   CREATE SEQUENCE public.bitacora_idbitacora_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 .   DROP SEQUENCE public.bitacora_idbitacora_seq;
       public          postgres    false    204            �           0    0    bitacora_idbitacora_seq    SEQUENCE OWNED BY     S   ALTER SEQUENCE public.bitacora_idbitacora_seq OWNED BY public.bitacora.idbitacora;
          public          postgres    false    205            �            1259    17519    bitacoraresidente    TABLE       CREATE TABLE public.bitacoraresidente (
    idbitacora integer NOT NULL,
    idresidente integer NOT NULL,
    hora time without time zone NOT NULL,
    fecha date NOT NULL,
    accion character varying(20) NOT NULL,
    descripcion character varying(200) NOT NULL
);
 %   DROP TABLE public.bitacoraresidente;
       public         heap    postgres    false            �            1259    17522     bitacoraresidente_idbitacora_seq    SEQUENCE     �   CREATE SEQUENCE public.bitacoraresidente_idbitacora_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 7   DROP SEQUENCE public.bitacoraresidente_idbitacora_seq;
       public          postgres    false    206            �           0    0     bitacoraresidente_idbitacora_seq    SEQUENCE OWNED BY     e   ALTER SEQUENCE public.bitacoraresidente_idbitacora_seq OWNED BY public.bitacoraresidente.idbitacora;
          public          postgres    false    207            �            1259    17524    casa    TABLE     �   CREATE TABLE public.casa (
    idcasa integer NOT NULL,
    idestadocasa integer NOT NULL,
    numerocasa numeric NOT NULL,
    direccion character varying(200) NOT NULL
);
    DROP TABLE public.casa;
       public         heap    postgres    false            �            1259    17530    casa_idcasa_seq    SEQUENCE     �   CREATE SEQUENCE public.casa_idcasa_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.casa_idcasa_seq;
       public          postgres    false    208            �           0    0    casa_idcasa_seq    SEQUENCE OWNED BY     C   ALTER SEQUENCE public.casa_idcasa_seq OWNED BY public.casa.idcasa;
          public          postgres    false    209            �            1259    17532 	   categoria    TABLE     r   CREATE TABLE public.categoria (
    idcategoria integer NOT NULL,
    categoria character varying(40) NOT NULL
);
    DROP TABLE public.categoria;
       public         heap    postgres    false            �            1259    17535    categoria_idcategoria_seq    SEQUENCE     �   CREATE SEQUENCE public.categoria_idcategoria_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 0   DROP SEQUENCE public.categoria_idcategoria_seq;
       public          postgres    false    210            �           0    0    categoria_idcategoria_seq    SEQUENCE OWNED BY     W   ALTER SEQUENCE public.categoria_idcategoria_seq OWNED BY public.categoria.idcategoria;
          public          postgres    false    211            �            1259    17537    denuncia    TABLE     8  CREATE TABLE public.denuncia (
    iddenuncia integer NOT NULL,
    idempleado integer,
    idresidente integer NOT NULL,
    idtipodenuncia integer NOT NULL,
    idestadodenuncia integer NOT NULL,
    fecha date NOT NULL,
    descripcion character varying(200) NOT NULL,
    respuesta character varying(200)
);
    DROP TABLE public.denuncia;
       public         heap    postgres    false            �            1259    17540    denuncia_iddenuncia_seq    SEQUENCE     �   CREATE SEQUENCE public.denuncia_iddenuncia_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 .   DROP SEQUENCE public.denuncia_iddenuncia_seq;
       public          postgres    false    212            �           0    0    denuncia_iddenuncia_seq    SEQUENCE OWNED BY     S   ALTER SEQUENCE public.denuncia_iddenuncia_seq OWNED BY public.denuncia.iddenuncia;
          public          postgres    false    213            �            1259    17542    detallematerial    TABLE     �   CREATE TABLE public.detallematerial (
    iddetallematerial integer NOT NULL,
    idpedido integer NOT NULL,
    idmaterial integer NOT NULL,
    preciomaterial numeric NOT NULL,
    cantidadmaterial numeric NOT NULL
);
 #   DROP TABLE public.detallematerial;
       public         heap    postgres    false            �            1259    17548 %   detallematerial_iddetallematerial_seq    SEQUENCE     �   CREATE SEQUENCE public.detallematerial_iddetallematerial_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 <   DROP SEQUENCE public.detallematerial_iddetallematerial_seq;
       public          postgres    false    214            �           0    0 %   detallematerial_iddetallematerial_seq    SEQUENCE OWNED BY     o   ALTER SEQUENCE public.detallematerial_iddetallematerial_seq OWNED BY public.detallematerial.iddetallematerial;
          public          postgres    false    215            �            1259    17550    detallevisita    TABLE     �   CREATE TABLE public.detallevisita (
    iddetallevisita integer NOT NULL,
    idvisita integer NOT NULL,
    idvisitante integer NOT NULL
);
 !   DROP TABLE public.detallevisita;
       public         heap    postgres    false            �            1259    17553 !   detallevisita_iddetallevisita_seq    SEQUENCE     �   CREATE SEQUENCE public.detallevisita_iddetallevisita_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 8   DROP SEQUENCE public.detallevisita_iddetallevisita_seq;
       public          postgres    false    216            �           0    0 !   detallevisita_iddetallevisita_seq    SEQUENCE OWNED BY     g   ALTER SEQUENCE public.detallevisita_iddetallevisita_seq OWNED BY public.detallevisita.iddetallevisita;
          public          postgres    false    217            �            1259    17555    empleado    TABLE     �  CREATE TABLE public.empleado (
    idempleado integer NOT NULL,
    idestadoempleado integer NOT NULL,
    idtipoempleado integer NOT NULL,
    nombre character varying(30) NOT NULL,
    apellido character varying(30) NOT NULL,
    telefono character(9) NOT NULL,
    dui character(10) NOT NULL,
    genero character(1) NOT NULL,
    foto character varying(50),
    direccion character varying(200) NOT NULL,
    correo character varying(50) NOT NULL,
    fechanacimiento date NOT NULL
);
    DROP TABLE public.empleado;
       public         heap    postgres    false            �            1259    17558    empleado_idempleado_seq    SEQUENCE     �   CREATE SEQUENCE public.empleado_idempleado_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 .   DROP SEQUENCE public.empleado_idempleado_seq;
       public          postgres    false    218            �           0    0    empleado_idempleado_seq    SEQUENCE OWNED BY     S   ALTER SEQUENCE public.empleado_idempleado_seq OWNED BY public.empleado.idempleado;
          public          postgres    false    219            �            1259    17560    espacio    TABLE       CREATE TABLE public.espacio (
    idespacio integer NOT NULL,
    idestadoespacio integer NOT NULL,
    nombre character varying(30) NOT NULL,
    descripcion character varying(200) NOT NULL,
    capacidad numeric NOT NULL,
    imagenprincipal character varying(50)
);
    DROP TABLE public.espacio;
       public         heap    postgres    false            �            1259    17566    espacio_idespacio_seq    SEQUENCE     �   CREATE SEQUENCE public.espacio_idespacio_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.espacio_idespacio_seq;
       public          postgres    false    220            �           0    0    espacio_idespacio_seq    SEQUENCE OWNED BY     O   ALTER SEQUENCE public.espacio_idespacio_seq OWNED BY public.espacio.idespacio;
          public          postgres    false    221            �            1259    17568    estadoalquiler    TABLE     �   CREATE TABLE public.estadoalquiler (
    idestadoalquiler integer NOT NULL,
    estadoalquiler character varying(15) NOT NULL
);
 "   DROP TABLE public.estadoalquiler;
       public         heap    postgres    false            �            1259    17571 #   estadoalquiler_idestadoalquiler_seq    SEQUENCE     �   CREATE SEQUENCE public.estadoalquiler_idestadoalquiler_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 :   DROP SEQUENCE public.estadoalquiler_idestadoalquiler_seq;
       public          postgres    false    222            �           0    0 #   estadoalquiler_idestadoalquiler_seq    SEQUENCE OWNED BY     k   ALTER SEQUENCE public.estadoalquiler_idestadoalquiler_seq OWNED BY public.estadoalquiler.idestadoalquiler;
          public          postgres    false    223            �            1259    17573    estadoaportacion    TABLE     �   CREATE TABLE public.estadoaportacion (
    idestadoaportacion integer NOT NULL,
    estadoaportacion character varying(15) NOT NULL
);
 $   DROP TABLE public.estadoaportacion;
       public         heap    postgres    false            �            1259    17576 '   estadoaportacion_idestadoaportacion_seq    SEQUENCE     �   CREATE SEQUENCE public.estadoaportacion_idestadoaportacion_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 >   DROP SEQUENCE public.estadoaportacion_idestadoaportacion_seq;
       public          postgres    false    224            �           0    0 '   estadoaportacion_idestadoaportacion_seq    SEQUENCE OWNED BY     s   ALTER SEQUENCE public.estadoaportacion_idestadoaportacion_seq OWNED BY public.estadoaportacion.idestadoaportacion;
          public          postgres    false    225            �            1259    17578 
   estadocasa    TABLE     u   CREATE TABLE public.estadocasa (
    idestadocasa integer NOT NULL,
    estadocasa character varying(15) NOT NULL
);
    DROP TABLE public.estadocasa;
       public         heap    postgres    false            �            1259    17581    estadocasa_idestadocasa_seq    SEQUENCE     �   CREATE SEQUENCE public.estadocasa_idestadocasa_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 2   DROP SEQUENCE public.estadocasa_idestadocasa_seq;
       public          postgres    false    226            �           0    0    estadocasa_idestadocasa_seq    SEQUENCE OWNED BY     [   ALTER SEQUENCE public.estadocasa_idestadocasa_seq OWNED BY public.estadocasa.idestadocasa;
          public          postgres    false    227            �            1259    17583    estadodenuncia    TABLE     �   CREATE TABLE public.estadodenuncia (
    idestadodenuncia integer NOT NULL,
    estadodenuncia character varying(15) NOT NULL
);
 "   DROP TABLE public.estadodenuncia;
       public         heap    postgres    false            �            1259    17586 #   estadodenuncia_idestadodenuncia_seq    SEQUENCE     �   CREATE SEQUENCE public.estadodenuncia_idestadodenuncia_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 :   DROP SEQUENCE public.estadodenuncia_idestadodenuncia_seq;
       public          postgres    false    228            �           0    0 #   estadodenuncia_idestadodenuncia_seq    SEQUENCE OWNED BY     k   ALTER SEQUENCE public.estadodenuncia_idestadodenuncia_seq OWNED BY public.estadodenuncia.idestadodenuncia;
          public          postgres    false    229            �            1259    17588    estadoempleado    TABLE     �   CREATE TABLE public.estadoempleado (
    idestadoempleado integer NOT NULL,
    estadoempleado character varying(20) NOT NULL
);
 "   DROP TABLE public.estadoempleado;
       public         heap    postgres    false            �            1259    17591 #   estadoempleado_idestadoempleado_seq    SEQUENCE     �   CREATE SEQUENCE public.estadoempleado_idestadoempleado_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 :   DROP SEQUENCE public.estadoempleado_idestadoempleado_seq;
       public          postgres    false    230            �           0    0 #   estadoempleado_idestadoempleado_seq    SEQUENCE OWNED BY     k   ALTER SEQUENCE public.estadoempleado_idestadoempleado_seq OWNED BY public.estadoempleado.idestadoempleado;
          public          postgres    false    231            �            1259    17593    estadoespacio    TABLE     ~   CREATE TABLE public.estadoespacio (
    idestadoespacio integer NOT NULL,
    estadoespacio character varying(15) NOT NULL
);
 !   DROP TABLE public.estadoespacio;
       public         heap    postgres    false            �            1259    17596 !   estadoespacio_idestadoespacio_seq    SEQUENCE     �   CREATE SEQUENCE public.estadoespacio_idestadoespacio_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 8   DROP SEQUENCE public.estadoespacio_idestadoespacio_seq;
       public          postgres    false    232            �           0    0 !   estadoespacio_idestadoespacio_seq    SEQUENCE OWNED BY     g   ALTER SEQUENCE public.estadoespacio_idestadoespacio_seq OWNED BY public.estadoespacio.idestadoespacio;
          public          postgres    false    233            �            1259    17598    estadopedido    TABLE     {   CREATE TABLE public.estadopedido (
    idestadopedido integer NOT NULL,
    estadopedido character varying(15) NOT NULL
);
     DROP TABLE public.estadopedido;
       public         heap    postgres    false            �            1259    17601    estadopedido_idestadopedido_seq    SEQUENCE     �   CREATE SEQUENCE public.estadopedido_idestadopedido_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 6   DROP SEQUENCE public.estadopedido_idestadopedido_seq;
       public          postgres    false    234            �           0    0    estadopedido_idestadopedido_seq    SEQUENCE OWNED BY     c   ALTER SEQUENCE public.estadopedido_idestadopedido_seq OWNED BY public.estadopedido.idestadopedido;
          public          postgres    false    235            �            1259    17603    estadoresidente    TABLE     �   CREATE TABLE public.estadoresidente (
    idestadoresidente integer NOT NULL,
    estadoresidente character varying(15) NOT NULL
);
 #   DROP TABLE public.estadoresidente;
       public         heap    postgres    false            �            1259    17606 %   estadoresidente_idestadoresidente_seq    SEQUENCE     �   CREATE SEQUENCE public.estadoresidente_idestadoresidente_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 <   DROP SEQUENCE public.estadoresidente_idestadoresidente_seq;
       public          postgres    false    236            �           0    0 %   estadoresidente_idestadoresidente_seq    SEQUENCE OWNED BY     o   ALTER SEQUENCE public.estadoresidente_idestadoresidente_seq OWNED BY public.estadoresidente.idestadoresidente;
          public          postgres    false    237            �            1259    17608    estadousuario    TABLE     ~   CREATE TABLE public.estadousuario (
    idestadousuario integer NOT NULL,
    estadousuario character varying(20) NOT NULL
);
 !   DROP TABLE public.estadousuario;
       public         heap    postgres    false            �            1259    17611 !   estadousuario_idestadousuario_seq    SEQUENCE     �   CREATE SEQUENCE public.estadousuario_idestadousuario_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 8   DROP SEQUENCE public.estadousuario_idestadousuario_seq;
       public          postgres    false    238            �           0    0 !   estadousuario_idestadousuario_seq    SEQUENCE OWNED BY     g   ALTER SEQUENCE public.estadousuario_idestadousuario_seq OWNED BY public.estadousuario.idestadousuario;
          public          postgres    false    239            �            1259    17613    estadovisita    TABLE     {   CREATE TABLE public.estadovisita (
    idestadovisita integer NOT NULL,
    estadovisita character varying(15) NOT NULL
);
     DROP TABLE public.estadovisita;
       public         heap    postgres    false            �            1259    17616    estadovisita_idestadovisita_seq    SEQUENCE     �   CREATE SEQUENCE public.estadovisita_idestadovisita_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 6   DROP SEQUENCE public.estadovisita_idestadovisita_seq;
       public          postgres    false    240            �           0    0    estadovisita_idestadovisita_seq    SEQUENCE OWNED BY     c   ALTER SEQUENCE public.estadovisita_idestadovisita_seq OWNED BY public.estadovisita.idestadovisita;
          public          postgres    false    241            �            1259    17618    historialinventario    TABLE     �   CREATE TABLE public.historialinventario (
    idhistorialinventario integer NOT NULL,
    idmaterial integer NOT NULL,
    cantidad numeric NOT NULL,
    fecha date NOT NULL
);
 '   DROP TABLE public.historialinventario;
       public         heap    postgres    false            �            1259    17624 -   historialinventario_idhistorialinventario_seq    SEQUENCE     �   CREATE SEQUENCE public.historialinventario_idhistorialinventario_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 D   DROP SEQUENCE public.historialinventario_idhistorialinventario_seq;
       public          postgres    false    242            �           0    0 -   historialinventario_idhistorialinventario_seq    SEQUENCE OWNED BY        ALTER SEQUENCE public.historialinventario_idhistorialinventario_seq OWNED BY public.historialinventario.idhistorialinventario;
          public          postgres    false    243                       1259    26276    historialresidente    TABLE     
  CREATE TABLE public.historialresidente (
    idhistorial integer NOT NULL,
    idresidente integer,
    ip character varying(40),
    region character varying(40),
    sistema character varying(40),
    fecha timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);
 &   DROP TABLE public.historialresidente;
       public         heap    postgres    false                       1259    26274 "   historialresidente_idhistorial_seq    SEQUENCE     �   CREATE SEQUENCE public.historialresidente_idhistorial_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 9   DROP SEQUENCE public.historialresidente_idhistorial_seq;
       public          postgres    false    281            �           0    0 "   historialresidente_idhistorial_seq    SEQUENCE OWNED BY     i   ALTER SEQUENCE public.historialresidente_idhistorial_seq OWNED BY public.historialresidente.idhistorial;
          public          postgres    false    280                       1259    26262    historialusuario    TABLE       CREATE TABLE public.historialusuario (
    idhistorial integer NOT NULL,
    idusuario integer,
    ip character varying(40),
    region character varying(40),
    sistema character varying(40),
    fecha timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);
 $   DROP TABLE public.historialusuario;
       public         heap    postgres    false                       1259    26260     historialusuario_idhistorial_seq    SEQUENCE     �   CREATE SEQUENCE public.historialusuario_idhistorial_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 7   DROP SEQUENCE public.historialusuario_idhistorial_seq;
       public          postgres    false    279            �           0    0     historialusuario_idhistorial_seq    SEQUENCE OWNED BY     e   ALTER SEQUENCE public.historialusuario_idhistorial_seq OWNED BY public.historialusuario.idhistorial;
          public          postgres    false    278            �            1259    17626    imagenesespacio    TABLE     �   CREATE TABLE public.imagenesespacio (
    idimagenesespacio integer NOT NULL,
    imagen character varying(50),
    idespacio integer
);
 #   DROP TABLE public.imagenesespacio;
       public         heap    postgres    false            �            1259    17629 %   imagenesespacio_idimagenesespacio_seq    SEQUENCE     �   CREATE SEQUENCE public.imagenesespacio_idimagenesespacio_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 <   DROP SEQUENCE public.imagenesespacio_idimagenesespacio_seq;
       public          postgres    false    244            �           0    0 %   imagenesespacio_idimagenesespacio_seq    SEQUENCE OWNED BY     o   ALTER SEQUENCE public.imagenesespacio_idimagenesespacio_seq OWNED BY public.imagenesespacio.idimagenesespacio;
          public          postgres    false    245            �            1259    17631    marca    TABLE     f   CREATE TABLE public.marca (
    idmarca integer NOT NULL,
    marca character varying(15) NOT NULL
);
    DROP TABLE public.marca;
       public         heap    postgres    false            �            1259    17634    marca_idmarca_seq    SEQUENCE     �   CREATE SEQUENCE public.marca_idmarca_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.marca_idmarca_seq;
       public          postgres    false    246            �           0    0    marca_idmarca_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.marca_idmarca_seq OWNED BY public.marca.idmarca;
          public          postgres    false    247            �            1259    17636    material    TABLE     �  CREATE TABLE public.material (
    idmaterial integer NOT NULL,
    nombreproducto character varying(40) NOT NULL,
    costo numeric NOT NULL,
    imagen character varying(50),
    idcategoria integer NOT NULL,
    "tamaño" character varying(10) NOT NULL,
    descripcion character varying(200) NOT NULL,
    cantidad numeric NOT NULL,
    idmarca integer NOT NULL,
    idunidadmedida integer NOT NULL
);
    DROP TABLE public.material;
       public         heap    postgres    false            �            1259    17642    material_idmaterial_seq    SEQUENCE     �   CREATE SEQUENCE public.material_idmaterial_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 .   DROP SEQUENCE public.material_idmaterial_seq;
       public          postgres    false    248            �           0    0    material_idmaterial_seq    SEQUENCE OWNED BY     S   ALTER SEQUENCE public.material_idmaterial_seq OWNED BY public.material.idmaterial;
          public          postgres    false    249            �            1259    17644    mespago    TABLE     �   CREATE TABLE public.mespago (
    idmespago integer NOT NULL,
    mes character varying(10) NOT NULL,
    ano numeric NOT NULL
);
    DROP TABLE public.mespago;
       public         heap    postgres    false            �            1259    17650    mespago_idmespago_seq    SEQUENCE     �   CREATE SEQUENCE public.mespago_idmespago_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.mespago_idmespago_seq;
       public          postgres    false    250            �           0    0    mespago_idmespago_seq    SEQUENCE OWNED BY     O   ALTER SEQUENCE public.mespago_idmespago_seq OWNED BY public.mespago.idmespago;
          public          postgres    false    251            �            1259    17652    pedido    TABLE     �   CREATE TABLE public.pedido (
    idpedido integer NOT NULL,
    idestadopedido integer NOT NULL,
    idusuario integer NOT NULL,
    idempleado integer,
    fechapedido date NOT NULL
);
    DROP TABLE public.pedido;
       public         heap    postgres    false            �            1259    17655    pedido_idpedido_seq    SEQUENCE     �   CREATE SEQUENCE public.pedido_idpedido_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE public.pedido_idpedido_seq;
       public          postgres    false    252            �           0    0    pedido_idpedido_seq    SEQUENCE OWNED BY     K   ALTER SEQUENCE public.pedido_idpedido_seq OWNED BY public.pedido.idpedido;
          public          postgres    false    253            �            1259    17657    permiso    TABLE     l   CREATE TABLE public.permiso (
    idpermiso integer NOT NULL,
    permiso character varying(30) NOT NULL
);
    DROP TABLE public.permiso;
       public         heap    postgres    false            �            1259    17660    permiso_idpermiso_seq    SEQUENCE     �   CREATE SEQUENCE public.permiso_idpermiso_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.permiso_idpermiso_seq;
       public          postgres    false    254            �           0    0    permiso_idpermiso_seq    SEQUENCE OWNED BY     O   ALTER SEQUENCE public.permiso_idpermiso_seq OWNED BY public.permiso.idpermiso;
          public          postgres    false    255                        1259    17662    permisousuario    TABLE     �   CREATE TABLE public.permisousuario (
    idpermisousuario integer NOT NULL,
    idtipousuario integer NOT NULL,
    idpermiso integer NOT NULL,
    permitido character(1) NOT NULL
);
 "   DROP TABLE public.permisousuario;
       public         heap    postgres    false                       1259    17665 #   permisousuario_idpermisousuario_seq    SEQUENCE     �   CREATE SEQUENCE public.permisousuario_idpermisousuario_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 :   DROP SEQUENCE public.permisousuario_idpermisousuario_seq;
       public          postgres    false    256            �           0    0 #   permisousuario_idpermisousuario_seq    SEQUENCE OWNED BY     k   ALTER SEQUENCE public.permisousuario_idpermisousuario_seq OWNED BY public.permisousuario.idpermisousuario;
          public          postgres    false    257                       1259    17667 	   residente    TABLE     �  CREATE TABLE public.residente (
    idresidente integer NOT NULL,
    idestadoresidente integer,
    nombre character varying(30) NOT NULL,
    apellido character varying(30) NOT NULL,
    telefonofijo character(9) NOT NULL,
    telefonocelular character(9) NOT NULL,
    foto character varying(50),
    correo character varying(50) NOT NULL,
    fechanacimiento date NOT NULL,
    genero character(1) NOT NULL,
    dui character(10) NOT NULL,
    username character varying(25) NOT NULL,
    contrasena character varying(60) NOT NULL,
    modo character varying(6),
    intentos integer NOT NULL,
    codigo integer,
    autenticacion character(2),
    verificado character(1) DEFAULT '0'::bpchar
);
    DROP TABLE public.residente;
       public         heap    postgres    false                       1259    17670    residente_idresidente_seq    SEQUENCE     �   CREATE SEQUENCE public.residente_idresidente_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 0   DROP SEQUENCE public.residente_idresidente_seq;
       public          postgres    false    258            �           0    0    residente_idresidente_seq    SEQUENCE OWNED BY     W   ALTER SEQUENCE public.residente_idresidente_seq OWNED BY public.residente.idresidente;
          public          postgres    false    259                       1259    17672    residentecasa    TABLE     �   CREATE TABLE public.residentecasa (
    idresidentecasa integer NOT NULL,
    idresidente integer NOT NULL,
    idcasa integer NOT NULL
);
 !   DROP TABLE public.residentecasa;
       public         heap    postgres    false                       1259    17675 !   residentecasa_idresidentecasa_seq    SEQUENCE     �   CREATE SEQUENCE public.residentecasa_idresidentecasa_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 8   DROP SEQUENCE public.residentecasa_idresidentecasa_seq;
       public          postgres    false    260            �           0    0 !   residentecasa_idresidentecasa_seq    SEQUENCE OWNED BY     g   ALTER SEQUENCE public.residentecasa_idresidentecasa_seq OWNED BY public.residentecasa.idresidentecasa;
          public          postgres    false    261                       1259    17677    tipodenuncia    TABLE     {   CREATE TABLE public.tipodenuncia (
    idtipodenuncia integer NOT NULL,
    tipodenuncia character varying(15) NOT NULL
);
     DROP TABLE public.tipodenuncia;
       public         heap    postgres    false                       1259    17680    tipodenuncia_idtipodenuncia_seq    SEQUENCE     �   CREATE SEQUENCE public.tipodenuncia_idtipodenuncia_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 6   DROP SEQUENCE public.tipodenuncia_idtipodenuncia_seq;
       public          postgres    false    262            �           0    0    tipodenuncia_idtipodenuncia_seq    SEQUENCE OWNED BY     c   ALTER SEQUENCE public.tipodenuncia_idtipodenuncia_seq OWNED BY public.tipodenuncia.idtipodenuncia;
          public          postgres    false    263                       1259    17682    tipoempleado    TABLE     {   CREATE TABLE public.tipoempleado (
    idtipoempleado integer NOT NULL,
    tipoempleado character varying(15) NOT NULL
);
     DROP TABLE public.tipoempleado;
       public         heap    postgres    false            	           1259    17685    tipoempleado_idtipoempleado_seq    SEQUENCE     �   CREATE SEQUENCE public.tipoempleado_idtipoempleado_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 6   DROP SEQUENCE public.tipoempleado_idtipoempleado_seq;
       public          postgres    false    264            �           0    0    tipoempleado_idtipoempleado_seq    SEQUENCE OWNED BY     c   ALTER SEQUENCE public.tipoempleado_idtipoempleado_seq OWNED BY public.tipoempleado.idtipoempleado;
          public          postgres    false    265            
           1259    17687 
   tipounidad    TABLE     u   CREATE TABLE public.tipounidad (
    idtipounidad integer NOT NULL,
    tipounidad character varying(20) NOT NULL
);
    DROP TABLE public.tipounidad;
       public         heap    postgres    false                       1259    17690    tipounidad_idtipounidad_seq    SEQUENCE     �   CREATE SEQUENCE public.tipounidad_idtipounidad_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 2   DROP SEQUENCE public.tipounidad_idtipounidad_seq;
       public          postgres    false    266            �           0    0    tipounidad_idtipounidad_seq    SEQUENCE OWNED BY     [   ALTER SEQUENCE public.tipounidad_idtipounidad_seq OWNED BY public.tipounidad.idtipounidad;
          public          postgres    false    267                       1259    17692    tipousuario    TABLE     x   CREATE TABLE public.tipousuario (
    idtipousuario integer NOT NULL,
    tipousuario character varying(15) NOT NULL
);
    DROP TABLE public.tipousuario;
       public         heap    postgres    false                       1259    17695    tipousuario_idtipousuario_seq    SEQUENCE     �   CREATE SEQUENCE public.tipousuario_idtipousuario_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 4   DROP SEQUENCE public.tipousuario_idtipousuario_seq;
       public          postgres    false    268            �           0    0    tipousuario_idtipousuario_seq    SEQUENCE OWNED BY     _   ALTER SEQUENCE public.tipousuario_idtipousuario_seq OWNED BY public.tipousuario.idtipousuario;
          public          postgres    false    269                       1259    17697    unidadmedida    TABLE     �   CREATE TABLE public.unidadmedida (
    idunidadmedida integer NOT NULL,
    idtipounidad integer NOT NULL,
    unidadmedida character varying(15) NOT NULL
);
     DROP TABLE public.unidadmedida;
       public         heap    postgres    false                       1259    17700    unidadmedida_idunidadmedida_seq    SEQUENCE     �   CREATE SEQUENCE public.unidadmedida_idunidadmedida_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 6   DROP SEQUENCE public.unidadmedida_idunidadmedida_seq;
       public          postgres    false    270            �           0    0    unidadmedida_idunidadmedida_seq    SEQUENCE OWNED BY     c   ALTER SEQUENCE public.unidadmedida_idunidadmedida_seq OWNED BY public.unidadmedida.idunidadmedida;
          public          postgres    false    271                       1259    17702    usuario    TABLE       CREATE TABLE public.usuario (
    idusuario integer NOT NULL,
    idestadousuario integer NOT NULL,
    idtipousuario integer NOT NULL,
    nombre character varying(30) NOT NULL,
    apellido character varying(30) NOT NULL,
    telefonofijo character(9) NOT NULL,
    telefonocelular character(9) NOT NULL,
    foto character varying(50),
    correo character varying(50) NOT NULL,
    fechanacimiento date NOT NULL,
    genero character(1) NOT NULL,
    dui character(10) NOT NULL,
    username character varying(25) NOT NULL,
    contrasena character varying(60) NOT NULL,
    direccion character varying(200) NOT NULL,
    modo character varying(6),
    intentos integer NOT NULL,
    codigo integer,
    autenticacion character(2) NOT NULL,
    verificado character(1) DEFAULT '0'::bpchar
);
    DROP TABLE public.usuario;
       public         heap    postgres    false                       1259    17708    usuario_idusuario_seq    SEQUENCE     �   CREATE SEQUENCE public.usuario_idusuario_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.usuario_idusuario_seq;
       public          postgres    false    272            �           0    0    usuario_idusuario_seq    SEQUENCE OWNED BY     O   ALTER SEQUENCE public.usuario_idusuario_seq OWNED BY public.usuario.idusuario;
          public          postgres    false    273                       1259    17710    visita    TABLE     �   CREATE TABLE public.visita (
    idvisita integer NOT NULL,
    idresidente integer NOT NULL,
    fecha date NOT NULL,
    visitarecurrente character(2) NOT NULL,
    observacion character varying(200) NOT NULL,
    idestadovisita integer NOT NULL
);
    DROP TABLE public.visita;
       public         heap    postgres    false                       1259    17713    visita_idvisita_seq    SEQUENCE     �   CREATE SEQUENCE public.visita_idvisita_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE public.visita_idvisita_seq;
       public          postgres    false    274            �           0    0    visita_idvisita_seq    SEQUENCE OWNED BY     K   ALTER SEQUENCE public.visita_idvisita_seq OWNED BY public.visita.idvisita;
          public          postgres    false    275                       1259    17715 	   visitante    TABLE       CREATE TABLE public.visitante (
    idvisitante integer NOT NULL,
    nombre character varying(30) NOT NULL,
    apellido character varying(30) NOT NULL,
    dui character(10) NOT NULL,
    genero character(1) NOT NULL,
    placa character varying(10) NOT NULL
);
    DROP TABLE public.visitante;
       public         heap    postgres    false                       1259    17718    visitante_idvisitante_seq    SEQUENCE     �   CREATE SEQUENCE public.visitante_idvisitante_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 0   DROP SEQUENCE public.visitante_idvisitante_seq;
       public          postgres    false    276            �           0    0    visitante_idvisitante_seq    SEQUENCE OWNED BY     W   ALTER SEQUENCE public.visitante_idvisitante_seq OWNED BY public.visitante.idvisitante;
          public          postgres    false    277                       2604    17720    alquiler idalquiler    DEFAULT     z   ALTER TABLE ONLY public.alquiler ALTER COLUMN idalquiler SET DEFAULT nextval('public.alquiler_idalquiler_seq'::regclass);
 B   ALTER TABLE public.alquiler ALTER COLUMN idalquiler DROP DEFAULT;
       public          postgres    false    201    200                       2604    17721    aportacion idaportacion    DEFAULT     �   ALTER TABLE ONLY public.aportacion ALTER COLUMN idaportacion SET DEFAULT nextval('public.aportacion_idaportacion_seq'::regclass);
 F   ALTER TABLE public.aportacion ALTER COLUMN idaportacion DROP DEFAULT;
       public          postgres    false    203    202                       2604    17722    bitacora idbitacora    DEFAULT     z   ALTER TABLE ONLY public.bitacora ALTER COLUMN idbitacora SET DEFAULT nextval('public.bitacora_idbitacora_seq'::regclass);
 B   ALTER TABLE public.bitacora ALTER COLUMN idbitacora DROP DEFAULT;
       public          postgres    false    205    204                       2604    17723    bitacoraresidente idbitacora    DEFAULT     �   ALTER TABLE ONLY public.bitacoraresidente ALTER COLUMN idbitacora SET DEFAULT nextval('public.bitacoraresidente_idbitacora_seq'::regclass);
 K   ALTER TABLE public.bitacoraresidente ALTER COLUMN idbitacora DROP DEFAULT;
       public          postgres    false    207    206                        2604    17724    casa idcasa    DEFAULT     j   ALTER TABLE ONLY public.casa ALTER COLUMN idcasa SET DEFAULT nextval('public.casa_idcasa_seq'::regclass);
 :   ALTER TABLE public.casa ALTER COLUMN idcasa DROP DEFAULT;
       public          postgres    false    209    208            !           2604    17725    categoria idcategoria    DEFAULT     ~   ALTER TABLE ONLY public.categoria ALTER COLUMN idcategoria SET DEFAULT nextval('public.categoria_idcategoria_seq'::regclass);
 D   ALTER TABLE public.categoria ALTER COLUMN idcategoria DROP DEFAULT;
       public          postgres    false    211    210            "           2604    17726    denuncia iddenuncia    DEFAULT     z   ALTER TABLE ONLY public.denuncia ALTER COLUMN iddenuncia SET DEFAULT nextval('public.denuncia_iddenuncia_seq'::regclass);
 B   ALTER TABLE public.denuncia ALTER COLUMN iddenuncia DROP DEFAULT;
       public          postgres    false    213    212            #           2604    17727 !   detallematerial iddetallematerial    DEFAULT     �   ALTER TABLE ONLY public.detallematerial ALTER COLUMN iddetallematerial SET DEFAULT nextval('public.detallematerial_iddetallematerial_seq'::regclass);
 P   ALTER TABLE public.detallematerial ALTER COLUMN iddetallematerial DROP DEFAULT;
       public          postgres    false    215    214            $           2604    17728    detallevisita iddetallevisita    DEFAULT     �   ALTER TABLE ONLY public.detallevisita ALTER COLUMN iddetallevisita SET DEFAULT nextval('public.detallevisita_iddetallevisita_seq'::regclass);
 L   ALTER TABLE public.detallevisita ALTER COLUMN iddetallevisita DROP DEFAULT;
       public          postgres    false    217    216            %           2604    17729    empleado idempleado    DEFAULT     z   ALTER TABLE ONLY public.empleado ALTER COLUMN idempleado SET DEFAULT nextval('public.empleado_idempleado_seq'::regclass);
 B   ALTER TABLE public.empleado ALTER COLUMN idempleado DROP DEFAULT;
       public          postgres    false    219    218            &           2604    17730    espacio idespacio    DEFAULT     v   ALTER TABLE ONLY public.espacio ALTER COLUMN idespacio SET DEFAULT nextval('public.espacio_idespacio_seq'::regclass);
 @   ALTER TABLE public.espacio ALTER COLUMN idespacio DROP DEFAULT;
       public          postgres    false    221    220            '           2604    17731    estadoalquiler idestadoalquiler    DEFAULT     �   ALTER TABLE ONLY public.estadoalquiler ALTER COLUMN idestadoalquiler SET DEFAULT nextval('public.estadoalquiler_idestadoalquiler_seq'::regclass);
 N   ALTER TABLE public.estadoalquiler ALTER COLUMN idestadoalquiler DROP DEFAULT;
       public          postgres    false    223    222            (           2604    17732 #   estadoaportacion idestadoaportacion    DEFAULT     �   ALTER TABLE ONLY public.estadoaportacion ALTER COLUMN idestadoaportacion SET DEFAULT nextval('public.estadoaportacion_idestadoaportacion_seq'::regclass);
 R   ALTER TABLE public.estadoaportacion ALTER COLUMN idestadoaportacion DROP DEFAULT;
       public          postgres    false    225    224            )           2604    17733    estadocasa idestadocasa    DEFAULT     �   ALTER TABLE ONLY public.estadocasa ALTER COLUMN idestadocasa SET DEFAULT nextval('public.estadocasa_idestadocasa_seq'::regclass);
 F   ALTER TABLE public.estadocasa ALTER COLUMN idestadocasa DROP DEFAULT;
       public          postgres    false    227    226            *           2604    17734    estadodenuncia idestadodenuncia    DEFAULT     �   ALTER TABLE ONLY public.estadodenuncia ALTER COLUMN idestadodenuncia SET DEFAULT nextval('public.estadodenuncia_idestadodenuncia_seq'::regclass);
 N   ALTER TABLE public.estadodenuncia ALTER COLUMN idestadodenuncia DROP DEFAULT;
       public          postgres    false    229    228            +           2604    17735    estadoempleado idestadoempleado    DEFAULT     �   ALTER TABLE ONLY public.estadoempleado ALTER COLUMN idestadoempleado SET DEFAULT nextval('public.estadoempleado_idestadoempleado_seq'::regclass);
 N   ALTER TABLE public.estadoempleado ALTER COLUMN idestadoempleado DROP DEFAULT;
       public          postgres    false    231    230            ,           2604    17736    estadoespacio idestadoespacio    DEFAULT     �   ALTER TABLE ONLY public.estadoespacio ALTER COLUMN idestadoespacio SET DEFAULT nextval('public.estadoespacio_idestadoespacio_seq'::regclass);
 L   ALTER TABLE public.estadoespacio ALTER COLUMN idestadoespacio DROP DEFAULT;
       public          postgres    false    233    232            -           2604    17737    estadopedido idestadopedido    DEFAULT     �   ALTER TABLE ONLY public.estadopedido ALTER COLUMN idestadopedido SET DEFAULT nextval('public.estadopedido_idestadopedido_seq'::regclass);
 J   ALTER TABLE public.estadopedido ALTER COLUMN idestadopedido DROP DEFAULT;
       public          postgres    false    235    234            .           2604    17738 !   estadoresidente idestadoresidente    DEFAULT     �   ALTER TABLE ONLY public.estadoresidente ALTER COLUMN idestadoresidente SET DEFAULT nextval('public.estadoresidente_idestadoresidente_seq'::regclass);
 P   ALTER TABLE public.estadoresidente ALTER COLUMN idestadoresidente DROP DEFAULT;
       public          postgres    false    237    236            /           2604    17739    estadousuario idestadousuario    DEFAULT     �   ALTER TABLE ONLY public.estadousuario ALTER COLUMN idestadousuario SET DEFAULT nextval('public.estadousuario_idestadousuario_seq'::regclass);
 L   ALTER TABLE public.estadousuario ALTER COLUMN idestadousuario DROP DEFAULT;
       public          postgres    false    239    238            0           2604    17740    estadovisita idestadovisita    DEFAULT     �   ALTER TABLE ONLY public.estadovisita ALTER COLUMN idestadovisita SET DEFAULT nextval('public.estadovisita_idestadovisita_seq'::regclass);
 J   ALTER TABLE public.estadovisita ALTER COLUMN idestadovisita DROP DEFAULT;
       public          postgres    false    241    240            1           2604    17741 )   historialinventario idhistorialinventario    DEFAULT     �   ALTER TABLE ONLY public.historialinventario ALTER COLUMN idhistorialinventario SET DEFAULT nextval('public.historialinventario_idhistorialinventario_seq'::regclass);
 X   ALTER TABLE public.historialinventario ALTER COLUMN idhistorialinventario DROP DEFAULT;
       public          postgres    false    243    242            G           2604    26279    historialresidente idhistorial    DEFAULT     �   ALTER TABLE ONLY public.historialresidente ALTER COLUMN idhistorial SET DEFAULT nextval('public.historialresidente_idhistorial_seq'::regclass);
 M   ALTER TABLE public.historialresidente ALTER COLUMN idhistorial DROP DEFAULT;
       public          postgres    false    280    281    281            E           2604    26265    historialusuario idhistorial    DEFAULT     �   ALTER TABLE ONLY public.historialusuario ALTER COLUMN idhistorial SET DEFAULT nextval('public.historialusuario_idhistorial_seq'::regclass);
 K   ALTER TABLE public.historialusuario ALTER COLUMN idhistorial DROP DEFAULT;
       public          postgres    false    278    279    279            2           2604    17742 !   imagenesespacio idimagenesespacio    DEFAULT     �   ALTER TABLE ONLY public.imagenesespacio ALTER COLUMN idimagenesespacio SET DEFAULT nextval('public.imagenesespacio_idimagenesespacio_seq'::regclass);
 P   ALTER TABLE public.imagenesespacio ALTER COLUMN idimagenesespacio DROP DEFAULT;
       public          postgres    false    245    244            3           2604    17743    marca idmarca    DEFAULT     n   ALTER TABLE ONLY public.marca ALTER COLUMN idmarca SET DEFAULT nextval('public.marca_idmarca_seq'::regclass);
 <   ALTER TABLE public.marca ALTER COLUMN idmarca DROP DEFAULT;
       public          postgres    false    247    246            4           2604    17744    material idmaterial    DEFAULT     z   ALTER TABLE ONLY public.material ALTER COLUMN idmaterial SET DEFAULT nextval('public.material_idmaterial_seq'::regclass);
 B   ALTER TABLE public.material ALTER COLUMN idmaterial DROP DEFAULT;
       public          postgres    false    249    248            5           2604    17745    mespago idmespago    DEFAULT     v   ALTER TABLE ONLY public.mespago ALTER COLUMN idmespago SET DEFAULT nextval('public.mespago_idmespago_seq'::regclass);
 @   ALTER TABLE public.mespago ALTER COLUMN idmespago DROP DEFAULT;
       public          postgres    false    251    250            6           2604    17746    pedido idpedido    DEFAULT     r   ALTER TABLE ONLY public.pedido ALTER COLUMN idpedido SET DEFAULT nextval('public.pedido_idpedido_seq'::regclass);
 >   ALTER TABLE public.pedido ALTER COLUMN idpedido DROP DEFAULT;
       public          postgres    false    253    252            7           2604    17747    permiso idpermiso    DEFAULT     v   ALTER TABLE ONLY public.permiso ALTER COLUMN idpermiso SET DEFAULT nextval('public.permiso_idpermiso_seq'::regclass);
 @   ALTER TABLE public.permiso ALTER COLUMN idpermiso DROP DEFAULT;
       public          postgres    false    255    254            8           2604    17748    permisousuario idpermisousuario    DEFAULT     �   ALTER TABLE ONLY public.permisousuario ALTER COLUMN idpermisousuario SET DEFAULT nextval('public.permisousuario_idpermisousuario_seq'::regclass);
 N   ALTER TABLE public.permisousuario ALTER COLUMN idpermisousuario DROP DEFAULT;
       public          postgres    false    257    256            9           2604    17749    residente idresidente    DEFAULT     ~   ALTER TABLE ONLY public.residente ALTER COLUMN idresidente SET DEFAULT nextval('public.residente_idresidente_seq'::regclass);
 D   ALTER TABLE public.residente ALTER COLUMN idresidente DROP DEFAULT;
       public          postgres    false    259    258            ;           2604    17750    residentecasa idresidentecasa    DEFAULT     �   ALTER TABLE ONLY public.residentecasa ALTER COLUMN idresidentecasa SET DEFAULT nextval('public.residentecasa_idresidentecasa_seq'::regclass);
 L   ALTER TABLE public.residentecasa ALTER COLUMN idresidentecasa DROP DEFAULT;
       public          postgres    false    261    260            <           2604    17751    tipodenuncia idtipodenuncia    DEFAULT     �   ALTER TABLE ONLY public.tipodenuncia ALTER COLUMN idtipodenuncia SET DEFAULT nextval('public.tipodenuncia_idtipodenuncia_seq'::regclass);
 J   ALTER TABLE public.tipodenuncia ALTER COLUMN idtipodenuncia DROP DEFAULT;
       public          postgres    false    263    262            =           2604    17752    tipoempleado idtipoempleado    DEFAULT     �   ALTER TABLE ONLY public.tipoempleado ALTER COLUMN idtipoempleado SET DEFAULT nextval('public.tipoempleado_idtipoempleado_seq'::regclass);
 J   ALTER TABLE public.tipoempleado ALTER COLUMN idtipoempleado DROP DEFAULT;
       public          postgres    false    265    264            >           2604    17753    tipounidad idtipounidad    DEFAULT     �   ALTER TABLE ONLY public.tipounidad ALTER COLUMN idtipounidad SET DEFAULT nextval('public.tipounidad_idtipounidad_seq'::regclass);
 F   ALTER TABLE public.tipounidad ALTER COLUMN idtipounidad DROP DEFAULT;
       public          postgres    false    267    266            ?           2604    17754    tipousuario idtipousuario    DEFAULT     �   ALTER TABLE ONLY public.tipousuario ALTER COLUMN idtipousuario SET DEFAULT nextval('public.tipousuario_idtipousuario_seq'::regclass);
 H   ALTER TABLE public.tipousuario ALTER COLUMN idtipousuario DROP DEFAULT;
       public          postgres    false    269    268            @           2604    17755    unidadmedida idunidadmedida    DEFAULT     �   ALTER TABLE ONLY public.unidadmedida ALTER COLUMN idunidadmedida SET DEFAULT nextval('public.unidadmedida_idunidadmedida_seq'::regclass);
 J   ALTER TABLE public.unidadmedida ALTER COLUMN idunidadmedida DROP DEFAULT;
       public          postgres    false    271    270            A           2604    17756    usuario idusuario    DEFAULT     v   ALTER TABLE ONLY public.usuario ALTER COLUMN idusuario SET DEFAULT nextval('public.usuario_idusuario_seq'::regclass);
 @   ALTER TABLE public.usuario ALTER COLUMN idusuario DROP DEFAULT;
       public          postgres    false    273    272            C           2604    17757    visita idvisita    DEFAULT     r   ALTER TABLE ONLY public.visita ALTER COLUMN idvisita SET DEFAULT nextval('public.visita_idvisita_seq'::regclass);
 >   ALTER TABLE public.visita ALTER COLUMN idvisita DROP DEFAULT;
       public          postgres    false    275    274            D           2604    17758    visitante idvisitante    DEFAULT     ~   ALTER TABLE ONLY public.visitante ALTER COLUMN idvisitante SET DEFAULT nextval('public.visitante_idvisitante_seq'::regclass);
 D   ALTER TABLE public.visitante ALTER COLUMN idvisitante DROP DEFAULT;
       public          postgres    false    277    276            k          0    17498    alquiler 
   TABLE DATA           �   COPY public.alquiler (idalquiler, idestadoalquiler, idespacio, precio, idusuario, idresidente, fecha, horainicio, horafin) FROM stdin;
    public          postgres    false    200   ��      m          0    17506 
   aportacion 
   TABLE DATA           x   COPY public.aportacion (idaportacion, idcasa, idestadoaportacion, monto, idmespago, fechapago, descripcion) FROM stdin;
    public          postgres    false    202   �      o          0    17514    bitacora 
   TABLE DATA           [   COPY public.bitacora (idbitacora, idusuario, hora, fecha, accion, descripcion) FROM stdin;
    public          postgres    false    204   E�      q          0    17519    bitacoraresidente 
   TABLE DATA           f   COPY public.bitacoraresidente (idbitacora, idresidente, hora, fecha, accion, descripcion) FROM stdin;
    public          postgres    false    206   L�      s          0    17524    casa 
   TABLE DATA           K   COPY public.casa (idcasa, idestadocasa, numerocasa, direccion) FROM stdin;
    public          postgres    false    208   Q�      u          0    17532 	   categoria 
   TABLE DATA           ;   COPY public.categoria (idcategoria, categoria) FROM stdin;
    public          postgres    false    210   ��      w          0    17537    denuncia 
   TABLE DATA           �   COPY public.denuncia (iddenuncia, idempleado, idresidente, idtipodenuncia, idestadodenuncia, fecha, descripcion, respuesta) FROM stdin;
    public          postgres    false    212   O�      y          0    17542    detallematerial 
   TABLE DATA           t   COPY public.detallematerial (iddetallematerial, idpedido, idmaterial, preciomaterial, cantidadmaterial) FROM stdin;
    public          postgres    false    214   l�      {          0    17550    detallevisita 
   TABLE DATA           O   COPY public.detallevisita (iddetallevisita, idvisita, idvisitante) FROM stdin;
    public          postgres    false    216   ��      }          0    17555    empleado 
   TABLE DATA           �   COPY public.empleado (idempleado, idestadoempleado, idtipoempleado, nombre, apellido, telefono, dui, genero, foto, direccion, correo, fechanacimiento) FROM stdin;
    public          postgres    false    218   �                0    17560    espacio 
   TABLE DATA           n   COPY public.espacio (idespacio, idestadoespacio, nombre, descripcion, capacidad, imagenprincipal) FROM stdin;
    public          postgres    false    220   4�      �          0    17568    estadoalquiler 
   TABLE DATA           J   COPY public.estadoalquiler (idestadoalquiler, estadoalquiler) FROM stdin;
    public          postgres    false    222   5�      �          0    17573    estadoaportacion 
   TABLE DATA           P   COPY public.estadoaportacion (idestadoaportacion, estadoaportacion) FROM stdin;
    public          postgres    false    224   }�      �          0    17578 
   estadocasa 
   TABLE DATA           >   COPY public.estadocasa (idestadocasa, estadocasa) FROM stdin;
    public          postgres    false    226   ��      �          0    17583    estadodenuncia 
   TABLE DATA           J   COPY public.estadodenuncia (idestadodenuncia, estadodenuncia) FROM stdin;
    public          postgres    false    228   ��      �          0    17588    estadoempleado 
   TABLE DATA           J   COPY public.estadoempleado (idestadoempleado, estadoempleado) FROM stdin;
    public          postgres    false    230   ;�      �          0    17593    estadoespacio 
   TABLE DATA           G   COPY public.estadoespacio (idestadoespacio, estadoespacio) FROM stdin;
    public          postgres    false    232   z�      �          0    17598    estadopedido 
   TABLE DATA           D   COPY public.estadopedido (idestadopedido, estadopedido) FROM stdin;
    public          postgres    false    234   ��      �          0    17603    estadoresidente 
   TABLE DATA           M   COPY public.estadoresidente (idestadoresidente, estadoresidente) FROM stdin;
    public          postgres    false    236   �      �          0    17608    estadousuario 
   TABLE DATA           G   COPY public.estadousuario (idestadousuario, estadousuario) FROM stdin;
    public          postgres    false    238   A�      �          0    17613    estadovisita 
   TABLE DATA           D   COPY public.estadovisita (idestadovisita, estadovisita) FROM stdin;
    public          postgres    false    240   x�      �          0    17618    historialinventario 
   TABLE DATA           a   COPY public.historialinventario (idhistorialinventario, idmaterial, cantidad, fecha) FROM stdin;
    public          postgres    false    242   ��      �          0    26276    historialresidente 
   TABLE DATA           b   COPY public.historialresidente (idhistorial, idresidente, ip, region, sistema, fecha) FROM stdin;
    public          postgres    false    281   *�      �          0    26262    historialusuario 
   TABLE DATA           ^   COPY public.historialusuario (idhistorial, idusuario, ip, region, sistema, fecha) FROM stdin;
    public          postgres    false    279   ��      �          0    17626    imagenesespacio 
   TABLE DATA           O   COPY public.imagenesespacio (idimagenesespacio, imagen, idespacio) FROM stdin;
    public          postgres    false    244   /�      �          0    17631    marca 
   TABLE DATA           /   COPY public.marca (idmarca, marca) FROM stdin;
    public          postgres    false    246   ��      �          0    17636    material 
   TABLE DATA           �   COPY public.material (idmaterial, nombreproducto, costo, imagen, idcategoria, "tamaño", descripcion, cantidad, idmarca, idunidadmedida) FROM stdin;
    public          postgres    false    248   ��      �          0    17644    mespago 
   TABLE DATA           6   COPY public.mespago (idmespago, mes, ano) FROM stdin;
    public          postgres    false    250   ��      �          0    17652    pedido 
   TABLE DATA           ^   COPY public.pedido (idpedido, idestadopedido, idusuario, idempleado, fechapedido) FROM stdin;
    public          postgres    false    252   �      �          0    17657    permiso 
   TABLE DATA           5   COPY public.permiso (idpermiso, permiso) FROM stdin;
    public          postgres    false    254   ]�      �          0    17662    permisousuario 
   TABLE DATA           _   COPY public.permisousuario (idpermisousuario, idtipousuario, idpermiso, permitido) FROM stdin;
    public          postgres    false    256   ��      �          0    17667 	   residente 
   TABLE DATA           �   COPY public.residente (idresidente, idestadoresidente, nombre, apellido, telefonofijo, telefonocelular, foto, correo, fechanacimiento, genero, dui, username, contrasena, modo, intentos, codigo, autenticacion, verificado) FROM stdin;
    public          postgres    false    258   �      �          0    17672    residentecasa 
   TABLE DATA           M   COPY public.residentecasa (idresidentecasa, idresidente, idcasa) FROM stdin;
    public          postgres    false    260   .�      �          0    17677    tipodenuncia 
   TABLE DATA           D   COPY public.tipodenuncia (idtipodenuncia, tipodenuncia) FROM stdin;
    public          postgres    false    262   h�      �          0    17682    tipoempleado 
   TABLE DATA           D   COPY public.tipoempleado (idtipoempleado, tipoempleado) FROM stdin;
    public          postgres    false    264   ��      �          0    17687 
   tipounidad 
   TABLE DATA           >   COPY public.tipounidad (idtipounidad, tipounidad) FROM stdin;
    public          postgres    false    266   ��      �          0    17692    tipousuario 
   TABLE DATA           A   COPY public.tipousuario (idtipousuario, tipousuario) FROM stdin;
    public          postgres    false    268   �      �          0    17697    unidadmedida 
   TABLE DATA           R   COPY public.unidadmedida (idunidadmedida, idtipounidad, unidadmedida) FROM stdin;
    public          postgres    false    270   _�      �          0    17702    usuario 
   TABLE DATA           �   COPY public.usuario (idusuario, idestadousuario, idtipousuario, nombre, apellido, telefonofijo, telefonocelular, foto, correo, fechanacimiento, genero, dui, username, contrasena, direccion, modo, intentos, codigo, autenticacion, verificado) FROM stdin;
    public          postgres    false    272   ��      �          0    17710    visita 
   TABLE DATA           m   COPY public.visita (idvisita, idresidente, fecha, visitarecurrente, observacion, idestadovisita) FROM stdin;
    public          postgres    false    274   H�      �          0    17715 	   visitante 
   TABLE DATA           V   COPY public.visitante (idvisitante, nombre, apellido, dui, genero, placa) FROM stdin;
    public          postgres    false    276   C�      �           0    0    alquiler_idalquiler_seq    SEQUENCE SET     F   SELECT pg_catalog.setval('public.alquiler_idalquiler_seq', 82, true);
          public          postgres    false    201            �           0    0    aportacion_idaportacion_seq    SEQUENCE SET     K   SELECT pg_catalog.setval('public.aportacion_idaportacion_seq', 228, true);
          public          postgres    false    203            �           0    0    bitacora_idbitacora_seq    SEQUENCE SET     G   SELECT pg_catalog.setval('public.bitacora_idbitacora_seq', 120, true);
          public          postgres    false    205            �           0    0     bitacoraresidente_idbitacora_seq    SEQUENCE SET     N   SELECT pg_catalog.setval('public.bitacoraresidente_idbitacora_seq', 7, true);
          public          postgres    false    207            �           0    0    casa_idcasa_seq    SEQUENCE SET     >   SELECT pg_catalog.setval('public.casa_idcasa_seq', 11, true);
          public          postgres    false    209            �           0    0    categoria_idcategoria_seq    SEQUENCE SET     G   SELECT pg_catalog.setval('public.categoria_idcategoria_seq', 9, true);
          public          postgres    false    211            �           0    0    denuncia_iddenuncia_seq    SEQUENCE SET     F   SELECT pg_catalog.setval('public.denuncia_iddenuncia_seq', 20, true);
          public          postgres    false    213            �           0    0 %   detallematerial_iddetallematerial_seq    SEQUENCE SET     T   SELECT pg_catalog.setval('public.detallematerial_iddetallematerial_seq', 31, true);
          public          postgres    false    215            �           0    0 !   detallevisita_iddetallevisita_seq    SEQUENCE SET     O   SELECT pg_catalog.setval('public.detallevisita_iddetallevisita_seq', 6, true);
          public          postgres    false    217            �           0    0    empleado_idempleado_seq    SEQUENCE SET     F   SELECT pg_catalog.setval('public.empleado_idempleado_seq', 12, true);
          public          postgres    false    219            �           0    0    espacio_idespacio_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public.espacio_idespacio_seq', 5, true);
          public          postgres    false    221            �           0    0 #   estadoalquiler_idestadoalquiler_seq    SEQUENCE SET     Q   SELECT pg_catalog.setval('public.estadoalquiler_idestadoalquiler_seq', 4, true);
          public          postgres    false    223            �           0    0 '   estadoaportacion_idestadoaportacion_seq    SEQUENCE SET     U   SELECT pg_catalog.setval('public.estadoaportacion_idestadoaportacion_seq', 2, true);
          public          postgres    false    225            �           0    0    estadocasa_idestadocasa_seq    SEQUENCE SET     I   SELECT pg_catalog.setval('public.estadocasa_idestadocasa_seq', 2, true);
          public          postgres    false    227            �           0    0 #   estadodenuncia_idestadodenuncia_seq    SEQUENCE SET     Q   SELECT pg_catalog.setval('public.estadodenuncia_idestadodenuncia_seq', 5, true);
          public          postgres    false    229            �           0    0 #   estadoempleado_idestadoempleado_seq    SEQUENCE SET     Q   SELECT pg_catalog.setval('public.estadoempleado_idestadoempleado_seq', 3, true);
          public          postgres    false    231            �           0    0 !   estadoespacio_idestadoespacio_seq    SEQUENCE SET     O   SELECT pg_catalog.setval('public.estadoespacio_idestadoespacio_seq', 4, true);
          public          postgres    false    233            �           0    0    estadopedido_idestadopedido_seq    SEQUENCE SET     M   SELECT pg_catalog.setval('public.estadopedido_idestadopedido_seq', 4, true);
          public          postgres    false    235            �           0    0 %   estadoresidente_idestadoresidente_seq    SEQUENCE SET     S   SELECT pg_catalog.setval('public.estadoresidente_idestadoresidente_seq', 2, true);
          public          postgres    false    237            �           0    0 !   estadousuario_idestadousuario_seq    SEQUENCE SET     O   SELECT pg_catalog.setval('public.estadousuario_idestadousuario_seq', 2, true);
          public          postgres    false    239                        0    0    estadovisita_idestadovisita_seq    SEQUENCE SET     M   SELECT pg_catalog.setval('public.estadovisita_idestadovisita_seq', 3, true);
          public          postgres    false    241                       0    0 -   historialinventario_idhistorialinventario_seq    SEQUENCE SET     \   SELECT pg_catalog.setval('public.historialinventario_idhistorialinventario_seq', 17, true);
          public          postgres    false    243                       0    0 "   historialresidente_idhistorial_seq    SEQUENCE SET     P   SELECT pg_catalog.setval('public.historialresidente_idhistorial_seq', 2, true);
          public          postgres    false    280                       0    0     historialusuario_idhistorial_seq    SEQUENCE SET     O   SELECT pg_catalog.setval('public.historialusuario_idhistorial_seq', 10, true);
          public          postgres    false    278                       0    0 %   imagenesespacio_idimagenesespacio_seq    SEQUENCE SET     S   SELECT pg_catalog.setval('public.imagenesespacio_idimagenesespacio_seq', 3, true);
          public          postgres    false    245                       0    0    marca_idmarca_seq    SEQUENCE SET     ?   SELECT pg_catalog.setval('public.marca_idmarca_seq', 5, true);
          public          postgres    false    247                       0    0    material_idmaterial_seq    SEQUENCE SET     E   SELECT pg_catalog.setval('public.material_idmaterial_seq', 6, true);
          public          postgres    false    249                       0    0    mespago_idmespago_seq    SEQUENCE SET     D   SELECT pg_catalog.setval('public.mespago_idmespago_seq', 60, true);
          public          postgres    false    251                       0    0    pedido_idpedido_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.pedido_idpedido_seq', 7, true);
          public          postgres    false    253            	           0    0    permiso_idpermiso_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public.permiso_idpermiso_seq', 6, true);
          public          postgres    false    255            
           0    0 #   permisousuario_idpermisousuario_seq    SEQUENCE SET     S   SELECT pg_catalog.setval('public.permisousuario_idpermisousuario_seq', 127, true);
          public          postgres    false    257                       0    0    residente_idresidente_seq    SEQUENCE SET     H   SELECT pg_catalog.setval('public.residente_idresidente_seq', 18, true);
          public          postgres    false    259                       0    0 !   residentecasa_idresidentecasa_seq    SEQUENCE SET     P   SELECT pg_catalog.setval('public.residentecasa_idresidentecasa_seq', 10, true);
          public          postgres    false    261                       0    0    tipodenuncia_idtipodenuncia_seq    SEQUENCE SET     M   SELECT pg_catalog.setval('public.tipodenuncia_idtipodenuncia_seq', 3, true);
          public          postgres    false    263                       0    0    tipoempleado_idtipoempleado_seq    SEQUENCE SET     M   SELECT pg_catalog.setval('public.tipoempleado_idtipoempleado_seq', 3, true);
          public          postgres    false    265                       0    0    tipounidad_idtipounidad_seq    SEQUENCE SET     I   SELECT pg_catalog.setval('public.tipounidad_idtipounidad_seq', 3, true);
          public          postgres    false    267                       0    0    tipousuario_idtipousuario_seq    SEQUENCE SET     L   SELECT pg_catalog.setval('public.tipousuario_idtipousuario_seq', 23, true);
          public          postgres    false    269                       0    0    unidadmedida_idunidadmedida_seq    SEQUENCE SET     M   SELECT pg_catalog.setval('public.unidadmedida_idunidadmedida_seq', 3, true);
          public          postgres    false    271                       0    0    usuario_idusuario_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public.usuario_idusuario_seq', 9, true);
          public          postgres    false    273                       0    0    visita_idvisita_seq    SEQUENCE SET     B   SELECT pg_catalog.setval('public.visita_idvisita_seq', 26, true);
          public          postgres    false    275                       0    0    visitante_idvisitante_seq    SEQUENCE SET     G   SELECT pg_catalog.setval('public.visitante_idvisitante_seq', 7, true);
          public          postgres    false    277            J           2606    17760    alquiler alquiler_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.alquiler
    ADD CONSTRAINT alquiler_pkey PRIMARY KEY (idalquiler);
 @   ALTER TABLE ONLY public.alquiler DROP CONSTRAINT alquiler_pkey;
       public            postgres    false    200            L           2606    17762    aportacion aportacion_pkey 
   CONSTRAINT     b   ALTER TABLE ONLY public.aportacion
    ADD CONSTRAINT aportacion_pkey PRIMARY KEY (idaportacion);
 D   ALTER TABLE ONLY public.aportacion DROP CONSTRAINT aportacion_pkey;
       public            postgres    false    202            N           2606    17764    bitacora bitacora_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.bitacora
    ADD CONSTRAINT bitacora_pkey PRIMARY KEY (idbitacora);
 @   ALTER TABLE ONLY public.bitacora DROP CONSTRAINT bitacora_pkey;
       public            postgres    false    204            P           2606    17766 (   bitacoraresidente bitacoraresidente_pkey 
   CONSTRAINT     n   ALTER TABLE ONLY public.bitacoraresidente
    ADD CONSTRAINT bitacoraresidente_pkey PRIMARY KEY (idbitacora);
 R   ALTER TABLE ONLY public.bitacoraresidente DROP CONSTRAINT bitacoraresidente_pkey;
       public            postgres    false    206            R           2606    17768    casa casa_pkey 
   CONSTRAINT     P   ALTER TABLE ONLY public.casa
    ADD CONSTRAINT casa_pkey PRIMARY KEY (idcasa);
 8   ALTER TABLE ONLY public.casa DROP CONSTRAINT casa_pkey;
       public            postgres    false    208            V           2606    17770    categoria categoria_pkey 
   CONSTRAINT     _   ALTER TABLE ONLY public.categoria
    ADD CONSTRAINT categoria_pkey PRIMARY KEY (idcategoria);
 B   ALTER TABLE ONLY public.categoria DROP CONSTRAINT categoria_pkey;
       public            postgres    false    210            X           2606    17772    denuncia denuncia_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.denuncia
    ADD CONSTRAINT denuncia_pkey PRIMARY KEY (iddenuncia);
 @   ALTER TABLE ONLY public.denuncia DROP CONSTRAINT denuncia_pkey;
       public            postgres    false    212            Z           2606    17774 $   detallematerial detallematerial_pkey 
   CONSTRAINT     q   ALTER TABLE ONLY public.detallematerial
    ADD CONSTRAINT detallematerial_pkey PRIMARY KEY (iddetallematerial);
 N   ALTER TABLE ONLY public.detallematerial DROP CONSTRAINT detallematerial_pkey;
       public            postgres    false    214            \           2606    17776     detallevisita detallevisita_pkey 
   CONSTRAINT     k   ALTER TABLE ONLY public.detallevisita
    ADD CONSTRAINT detallevisita_pkey PRIMARY KEY (iddetallevisita);
 J   ALTER TABLE ONLY public.detallevisita DROP CONSTRAINT detallevisita_pkey;
       public            postgres    false    216            ^           2606    17778    empleado empleado_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.empleado
    ADD CONSTRAINT empleado_pkey PRIMARY KEY (idempleado);
 @   ALTER TABLE ONLY public.empleado DROP CONSTRAINT empleado_pkey;
       public            postgres    false    218            f           2606    17780    espacio espacio_pkey 
   CONSTRAINT     Y   ALTER TABLE ONLY public.espacio
    ADD CONSTRAINT espacio_pkey PRIMARY KEY (idespacio);
 >   ALTER TABLE ONLY public.espacio DROP CONSTRAINT espacio_pkey;
       public            postgres    false    220            j           2606    17782 "   estadoalquiler estadoalquiler_pkey 
   CONSTRAINT     n   ALTER TABLE ONLY public.estadoalquiler
    ADD CONSTRAINT estadoalquiler_pkey PRIMARY KEY (idestadoalquiler);
 L   ALTER TABLE ONLY public.estadoalquiler DROP CONSTRAINT estadoalquiler_pkey;
       public            postgres    false    222            l           2606    17784 &   estadoaportacion estadoaportacion_pkey 
   CONSTRAINT     t   ALTER TABLE ONLY public.estadoaportacion
    ADD CONSTRAINT estadoaportacion_pkey PRIMARY KEY (idestadoaportacion);
 P   ALTER TABLE ONLY public.estadoaportacion DROP CONSTRAINT estadoaportacion_pkey;
       public            postgres    false    224            n           2606    17786    estadocasa estadocasa_pkey 
   CONSTRAINT     b   ALTER TABLE ONLY public.estadocasa
    ADD CONSTRAINT estadocasa_pkey PRIMARY KEY (idestadocasa);
 D   ALTER TABLE ONLY public.estadocasa DROP CONSTRAINT estadocasa_pkey;
       public            postgres    false    226            p           2606    17788 "   estadodenuncia estadodenuncia_pkey 
   CONSTRAINT     n   ALTER TABLE ONLY public.estadodenuncia
    ADD CONSTRAINT estadodenuncia_pkey PRIMARY KEY (idestadodenuncia);
 L   ALTER TABLE ONLY public.estadodenuncia DROP CONSTRAINT estadodenuncia_pkey;
       public            postgres    false    228            r           2606    17790 "   estadoempleado estadoempleado_pkey 
   CONSTRAINT     n   ALTER TABLE ONLY public.estadoempleado
    ADD CONSTRAINT estadoempleado_pkey PRIMARY KEY (idestadoempleado);
 L   ALTER TABLE ONLY public.estadoempleado DROP CONSTRAINT estadoempleado_pkey;
       public            postgres    false    230            t           2606    17792     estadoespacio estadoespacio_pkey 
   CONSTRAINT     k   ALTER TABLE ONLY public.estadoespacio
    ADD CONSTRAINT estadoespacio_pkey PRIMARY KEY (idestadoespacio);
 J   ALTER TABLE ONLY public.estadoespacio DROP CONSTRAINT estadoespacio_pkey;
       public            postgres    false    232            v           2606    17794    estadopedido estadopedido_pkey 
   CONSTRAINT     h   ALTER TABLE ONLY public.estadopedido
    ADD CONSTRAINT estadopedido_pkey PRIMARY KEY (idestadopedido);
 H   ALTER TABLE ONLY public.estadopedido DROP CONSTRAINT estadopedido_pkey;
       public            postgres    false    234            x           2606    17796 $   estadoresidente estadoresidente_pkey 
   CONSTRAINT     q   ALTER TABLE ONLY public.estadoresidente
    ADD CONSTRAINT estadoresidente_pkey PRIMARY KEY (idestadoresidente);
 N   ALTER TABLE ONLY public.estadoresidente DROP CONSTRAINT estadoresidente_pkey;
       public            postgres    false    236            z           2606    17798     estadousuario estadousuario_pkey 
   CONSTRAINT     k   ALTER TABLE ONLY public.estadousuario
    ADD CONSTRAINT estadousuario_pkey PRIMARY KEY (idestadousuario);
 J   ALTER TABLE ONLY public.estadousuario DROP CONSTRAINT estadousuario_pkey;
       public            postgres    false    238            |           2606    17800    estadovisita estadovisita_pkey 
   CONSTRAINT     h   ALTER TABLE ONLY public.estadovisita
    ADD CONSTRAINT estadovisita_pkey PRIMARY KEY (idestadovisita);
 H   ALTER TABLE ONLY public.estadovisita DROP CONSTRAINT estadovisita_pkey;
       public            postgres    false    240            ~           2606    17802 ,   historialinventario historialinventario_pkey 
   CONSTRAINT     }   ALTER TABLE ONLY public.historialinventario
    ADD CONSTRAINT historialinventario_pkey PRIMARY KEY (idhistorialinventario);
 V   ALTER TABLE ONLY public.historialinventario DROP CONSTRAINT historialinventario_pkey;
       public            postgres    false    242            �           2606    26282 *   historialresidente historialresidente_pkey 
   CONSTRAINT     q   ALTER TABLE ONLY public.historialresidente
    ADD CONSTRAINT historialresidente_pkey PRIMARY KEY (idhistorial);
 T   ALTER TABLE ONLY public.historialresidente DROP CONSTRAINT historialresidente_pkey;
       public            postgres    false    281            �           2606    26268 &   historialusuario historialusuario_pkey 
   CONSTRAINT     m   ALTER TABLE ONLY public.historialusuario
    ADD CONSTRAINT historialusuario_pkey PRIMARY KEY (idhistorial);
 P   ALTER TABLE ONLY public.historialusuario DROP CONSTRAINT historialusuario_pkey;
       public            postgres    false    279            �           2606    17804 $   imagenesespacio imagenesespacio_pkey 
   CONSTRAINT     q   ALTER TABLE ONLY public.imagenesespacio
    ADD CONSTRAINT imagenesespacio_pkey PRIMARY KEY (idimagenesespacio);
 N   ALTER TABLE ONLY public.imagenesespacio DROP CONSTRAINT imagenesespacio_pkey;
       public            postgres    false    244            �           2606    17806    marca marca_pkey 
   CONSTRAINT     S   ALTER TABLE ONLY public.marca
    ADD CONSTRAINT marca_pkey PRIMARY KEY (idmarca);
 :   ALTER TABLE ONLY public.marca DROP CONSTRAINT marca_pkey;
       public            postgres    false    246            �           2606    17808    material material_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.material
    ADD CONSTRAINT material_pkey PRIMARY KEY (idmaterial);
 @   ALTER TABLE ONLY public.material DROP CONSTRAINT material_pkey;
       public            postgres    false    248            �           2606    17810    mespago mespago_pkey 
   CONSTRAINT     Y   ALTER TABLE ONLY public.mespago
    ADD CONSTRAINT mespago_pkey PRIMARY KEY (idmespago);
 >   ALTER TABLE ONLY public.mespago DROP CONSTRAINT mespago_pkey;
       public            postgres    false    250            �           2606    17812    pedido pedido_pkey 
   CONSTRAINT     V   ALTER TABLE ONLY public.pedido
    ADD CONSTRAINT pedido_pkey PRIMARY KEY (idpedido);
 <   ALTER TABLE ONLY public.pedido DROP CONSTRAINT pedido_pkey;
       public            postgres    false    252            �           2606    17814    permiso permiso_pkey 
   CONSTRAINT     Y   ALTER TABLE ONLY public.permiso
    ADD CONSTRAINT permiso_pkey PRIMARY KEY (idpermiso);
 >   ALTER TABLE ONLY public.permiso DROP CONSTRAINT permiso_pkey;
       public            postgres    false    254            �           2606    17816 "   permisousuario permisousuario_pkey 
   CONSTRAINT     n   ALTER TABLE ONLY public.permisousuario
    ADD CONSTRAINT permisousuario_pkey PRIMARY KEY (idpermisousuario);
 L   ALTER TABLE ONLY public.permisousuario DROP CONSTRAINT permisousuario_pkey;
       public            postgres    false    256            �           2606    17818    residente residente_pkey 
   CONSTRAINT     _   ALTER TABLE ONLY public.residente
    ADD CONSTRAINT residente_pkey PRIMARY KEY (idresidente);
 B   ALTER TABLE ONLY public.residente DROP CONSTRAINT residente_pkey;
       public            postgres    false    258            �           2606    17820     residentecasa residentecasa_pkey 
   CONSTRAINT     k   ALTER TABLE ONLY public.residentecasa
    ADD CONSTRAINT residentecasa_pkey PRIMARY KEY (idresidentecasa);
 J   ALTER TABLE ONLY public.residentecasa DROP CONSTRAINT residentecasa_pkey;
       public            postgres    false    260            �           2606    17822    tipodenuncia tipodenuncia_pkey 
   CONSTRAINT     h   ALTER TABLE ONLY public.tipodenuncia
    ADD CONSTRAINT tipodenuncia_pkey PRIMARY KEY (idtipodenuncia);
 H   ALTER TABLE ONLY public.tipodenuncia DROP CONSTRAINT tipodenuncia_pkey;
       public            postgres    false    262            �           2606    17824    tipoempleado tipoempleado_pkey 
   CONSTRAINT     h   ALTER TABLE ONLY public.tipoempleado
    ADD CONSTRAINT tipoempleado_pkey PRIMARY KEY (idtipoempleado);
 H   ALTER TABLE ONLY public.tipoempleado DROP CONSTRAINT tipoempleado_pkey;
       public            postgres    false    264            �           2606    17826    tipounidad tipounidad_pkey 
   CONSTRAINT     b   ALTER TABLE ONLY public.tipounidad
    ADD CONSTRAINT tipounidad_pkey PRIMARY KEY (idtipounidad);
 D   ALTER TABLE ONLY public.tipounidad DROP CONSTRAINT tipounidad_pkey;
       public            postgres    false    266            �           2606    17828    tipousuario tipousuario_pkey 
   CONSTRAINT     e   ALTER TABLE ONLY public.tipousuario
    ADD CONSTRAINT tipousuario_pkey PRIMARY KEY (idtipousuario);
 F   ALTER TABLE ONLY public.tipousuario DROP CONSTRAINT tipousuario_pkey;
       public            postgres    false    268            �           2606    17830    unidadmedida unidadmedida_pkey 
   CONSTRAINT     h   ALTER TABLE ONLY public.unidadmedida
    ADD CONSTRAINT unidadmedida_pkey PRIMARY KEY (idunidadmedida);
 H   ALTER TABLE ONLY public.unidadmedida DROP CONSTRAINT unidadmedida_pkey;
       public            postgres    false    270            T           2606    18069    casa uq_casa_numero 
   CONSTRAINT     T   ALTER TABLE ONLY public.casa
    ADD CONSTRAINT uq_casa_numero UNIQUE (numerocasa);
 =   ALTER TABLE ONLY public.casa DROP CONSTRAINT uq_casa_numero;
       public            postgres    false    208            `           2606    17832    empleado uq_empleado_correo 
   CONSTRAINT     X   ALTER TABLE ONLY public.empleado
    ADD CONSTRAINT uq_empleado_correo UNIQUE (correo);
 E   ALTER TABLE ONLY public.empleado DROP CONSTRAINT uq_empleado_correo;
       public            postgres    false    218            b           2606    17834    empleado uq_empleado_dui 
   CONSTRAINT     R   ALTER TABLE ONLY public.empleado
    ADD CONSTRAINT uq_empleado_dui UNIQUE (dui);
 B   ALTER TABLE ONLY public.empleado DROP CONSTRAINT uq_empleado_dui;
       public            postgres    false    218            d           2606    17836    empleado uq_empleado_telefono 
   CONSTRAINT     \   ALTER TABLE ONLY public.empleado
    ADD CONSTRAINT uq_empleado_telefono UNIQUE (telefono);
 G   ALTER TABLE ONLY public.empleado DROP CONSTRAINT uq_empleado_telefono;
       public            postgres    false    218            h           2606    17838    espacio uq_espacio_nombre 
   CONSTRAINT     V   ALTER TABLE ONLY public.espacio
    ADD CONSTRAINT uq_espacio_nombre UNIQUE (nombre);
 C   ALTER TABLE ONLY public.espacio DROP CONSTRAINT uq_espacio_nombre;
       public            postgres    false    220            �           2606    17840    residente uq_residente_correo 
   CONSTRAINT     Z   ALTER TABLE ONLY public.residente
    ADD CONSTRAINT uq_residente_correo UNIQUE (correo);
 G   ALTER TABLE ONLY public.residente DROP CONSTRAINT uq_residente_correo;
       public            postgres    false    258            �           2606    17842    residente uq_residente_dui 
   CONSTRAINT     T   ALTER TABLE ONLY public.residente
    ADD CONSTRAINT uq_residente_dui UNIQUE (dui);
 D   ALTER TABLE ONLY public.residente DROP CONSTRAINT uq_residente_dui;
       public            postgres    false    258            �           2606    17844 '   residente uq_residente_telefono_celular 
   CONSTRAINT     m   ALTER TABLE ONLY public.residente
    ADD CONSTRAINT uq_residente_telefono_celular UNIQUE (telefonocelular);
 Q   ALTER TABLE ONLY public.residente DROP CONSTRAINT uq_residente_telefono_celular;
       public            postgres    false    258            �           2606    17846 $   residente uq_residente_telefono_fijo 
   CONSTRAINT     g   ALTER TABLE ONLY public.residente
    ADD CONSTRAINT uq_residente_telefono_fijo UNIQUE (telefonofijo);
 N   ALTER TABLE ONLY public.residente DROP CONSTRAINT uq_residente_telefono_fijo;
       public            postgres    false    258            �           2606    17848    residente uq_residente_username 
   CONSTRAINT     ^   ALTER TABLE ONLY public.residente
    ADD CONSTRAINT uq_residente_username UNIQUE (username);
 I   ALTER TABLE ONLY public.residente DROP CONSTRAINT uq_residente_username;
       public            postgres    false    258            �           2606    17850    tipousuario uq_tipousuario 
   CONSTRAINT     \   ALTER TABLE ONLY public.tipousuario
    ADD CONSTRAINT uq_tipousuario UNIQUE (tipousuario);
 D   ALTER TABLE ONLY public.tipousuario DROP CONSTRAINT uq_tipousuario;
       public            postgres    false    268            �           2606    17852    usuario uq_usuario_correo 
   CONSTRAINT     V   ALTER TABLE ONLY public.usuario
    ADD CONSTRAINT uq_usuario_correo UNIQUE (correo);
 C   ALTER TABLE ONLY public.usuario DROP CONSTRAINT uq_usuario_correo;
       public            postgres    false    272            �           2606    17854    usuario uq_usuario_dui 
   CONSTRAINT     P   ALTER TABLE ONLY public.usuario
    ADD CONSTRAINT uq_usuario_dui UNIQUE (dui);
 @   ALTER TABLE ONLY public.usuario DROP CONSTRAINT uq_usuario_dui;
       public            postgres    false    272            �           2606    17856 #   usuario uq_usuario_telefono_celular 
   CONSTRAINT     i   ALTER TABLE ONLY public.usuario
    ADD CONSTRAINT uq_usuario_telefono_celular UNIQUE (telefonocelular);
 M   ALTER TABLE ONLY public.usuario DROP CONSTRAINT uq_usuario_telefono_celular;
       public            postgres    false    272            �           2606    17858     usuario uq_usuario_telefono_fijo 
   CONSTRAINT     c   ALTER TABLE ONLY public.usuario
    ADD CONSTRAINT uq_usuario_telefono_fijo UNIQUE (telefonofijo);
 J   ALTER TABLE ONLY public.usuario DROP CONSTRAINT uq_usuario_telefono_fijo;
       public            postgres    false    272            �           2606    17860    usuario uq_usuario_username 
   CONSTRAINT     Z   ALTER TABLE ONLY public.usuario
    ADD CONSTRAINT uq_usuario_username UNIQUE (username);
 E   ALTER TABLE ONLY public.usuario DROP CONSTRAINT uq_usuario_username;
       public            postgres    false    272            �           2606    17862    visitante uq_visitante_dui 
   CONSTRAINT     T   ALTER TABLE ONLY public.visitante
    ADD CONSTRAINT uq_visitante_dui UNIQUE (dui);
 D   ALTER TABLE ONLY public.visitante DROP CONSTRAINT uq_visitante_dui;
       public            postgres    false    276            �           2606    17864    visitante uq_visitante_placa 
   CONSTRAINT     X   ALTER TABLE ONLY public.visitante
    ADD CONSTRAINT uq_visitante_placa UNIQUE (placa);
 F   ALTER TABLE ONLY public.visitante DROP CONSTRAINT uq_visitante_placa;
       public            postgres    false    276            �           2606    17866    usuario usuario_pkey 
   CONSTRAINT     Y   ALTER TABLE ONLY public.usuario
    ADD CONSTRAINT usuario_pkey PRIMARY KEY (idusuario);
 >   ALTER TABLE ONLY public.usuario DROP CONSTRAINT usuario_pkey;
       public            postgres    false    272            �           2606    17868    visita visita_pkey 
   CONSTRAINT     V   ALTER TABLE ONLY public.visita
    ADD CONSTRAINT visita_pkey PRIMARY KEY (idvisita);
 <   ALTER TABLE ONLY public.visita DROP CONSTRAINT visita_pkey;
       public            postgres    false    274            �           2606    17870    visitante visitante_pkey 
   CONSTRAINT     _   ALTER TABLE ONLY public.visitante
    ADD CONSTRAINT visitante_pkey PRIMARY KEY (idvisitante);
 B   ALTER TABLE ONLY public.visitante DROP CONSTRAINT visitante_pkey;
       public            postgres    false    276            �           2620    17871    material tr_historialinventario    TRIGGER     �   CREATE TRIGGER tr_historialinventario BEFORE UPDATE ON public.material FOR EACH ROW EXECUTE FUNCTION public.sp_historialinventario();
 8   DROP TRIGGER tr_historialinventario ON public.material;
       public          postgres    false    282    248            �           2606    17872     alquiler alquiler_idespacio_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.alquiler
    ADD CONSTRAINT alquiler_idespacio_fkey FOREIGN KEY (idespacio) REFERENCES public.espacio(idespacio);
 J   ALTER TABLE ONLY public.alquiler DROP CONSTRAINT alquiler_idespacio_fkey;
       public          postgres    false    200    220    3174            �           2606    17877 '   alquiler alquiler_idestadoalquiler_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.alquiler
    ADD CONSTRAINT alquiler_idestadoalquiler_fkey FOREIGN KEY (idestadoalquiler) REFERENCES public.estadoalquiler(idestadoalquiler);
 Q   ALTER TABLE ONLY public.alquiler DROP CONSTRAINT alquiler_idestadoalquiler_fkey;
       public          postgres    false    200    222    3178            �           2606    17882 "   alquiler alquiler_idresidente_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.alquiler
    ADD CONSTRAINT alquiler_idresidente_fkey FOREIGN KEY (idresidente) REFERENCES public.residente(idresidente);
 L   ALTER TABLE ONLY public.alquiler DROP CONSTRAINT alquiler_idresidente_fkey;
       public          postgres    false    3214    200    258            �           2606    17887     alquiler alquiler_idusuario_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.alquiler
    ADD CONSTRAINT alquiler_idusuario_fkey FOREIGN KEY (idusuario) REFERENCES public.usuario(idusuario);
 J   ALTER TABLE ONLY public.alquiler DROP CONSTRAINT alquiler_idusuario_fkey;
       public          postgres    false    3250    272    200            �           2606    17892 !   aportacion aportacion_idcasa_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.aportacion
    ADD CONSTRAINT aportacion_idcasa_fkey FOREIGN KEY (idcasa) REFERENCES public.casa(idcasa);
 K   ALTER TABLE ONLY public.aportacion DROP CONSTRAINT aportacion_idcasa_fkey;
       public          postgres    false    202    208    3154            �           2606    17897 -   aportacion aportacion_idestadoaportacion_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.aportacion
    ADD CONSTRAINT aportacion_idestadoaportacion_fkey FOREIGN KEY (idestadoaportacion) REFERENCES public.estadoaportacion(idestadoaportacion);
 W   ALTER TABLE ONLY public.aportacion DROP CONSTRAINT aportacion_idestadoaportacion_fkey;
       public          postgres    false    3180    224    202            �           2606    17902 $   aportacion aportacion_idmespago_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.aportacion
    ADD CONSTRAINT aportacion_idmespago_fkey FOREIGN KEY (idmespago) REFERENCES public.mespago(idmespago);
 N   ALTER TABLE ONLY public.aportacion DROP CONSTRAINT aportacion_idmespago_fkey;
       public          postgres    false    202    250    3206            �           2606    17907     bitacora bitacora_idusuario_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.bitacora
    ADD CONSTRAINT bitacora_idusuario_fkey FOREIGN KEY (idusuario) REFERENCES public.usuario(idusuario);
 J   ALTER TABLE ONLY public.bitacora DROP CONSTRAINT bitacora_idusuario_fkey;
       public          postgres    false    204    272    3250            �           2606    17912 4   bitacoraresidente bitacoraresidente_idresidente_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.bitacoraresidente
    ADD CONSTRAINT bitacoraresidente_idresidente_fkey FOREIGN KEY (idresidente) REFERENCES public.residente(idresidente);
 ^   ALTER TABLE ONLY public.bitacoraresidente DROP CONSTRAINT bitacoraresidente_idresidente_fkey;
       public          postgres    false    206    3214    258            �           2606    17917    casa casa_idestadocasa_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.casa
    ADD CONSTRAINT casa_idestadocasa_fkey FOREIGN KEY (idestadocasa) REFERENCES public.estadocasa(idestadocasa);
 E   ALTER TABLE ONLY public.casa DROP CONSTRAINT casa_idestadocasa_fkey;
       public          postgres    false    3182    208    226            �           2606    17922 !   denuncia denuncia_idempleado_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.denuncia
    ADD CONSTRAINT denuncia_idempleado_fkey FOREIGN KEY (idempleado) REFERENCES public.empleado(idempleado);
 K   ALTER TABLE ONLY public.denuncia DROP CONSTRAINT denuncia_idempleado_fkey;
       public          postgres    false    3166    212    218            �           2606    17927 '   denuncia denuncia_idestadodenuncia_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.denuncia
    ADD CONSTRAINT denuncia_idestadodenuncia_fkey FOREIGN KEY (idestadodenuncia) REFERENCES public.estadodenuncia(idestadodenuncia);
 Q   ALTER TABLE ONLY public.denuncia DROP CONSTRAINT denuncia_idestadodenuncia_fkey;
       public          postgres    false    3184    212    228            �           2606    17932 "   denuncia denuncia_idresidente_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.denuncia
    ADD CONSTRAINT denuncia_idresidente_fkey FOREIGN KEY (idresidente) REFERENCES public.residente(idresidente);
 L   ALTER TABLE ONLY public.denuncia DROP CONSTRAINT denuncia_idresidente_fkey;
       public          postgres    false    212    3214    258            �           2606    17937 %   denuncia denuncia_idtipodenuncia_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.denuncia
    ADD CONSTRAINT denuncia_idtipodenuncia_fkey FOREIGN KEY (idtipodenuncia) REFERENCES public.tipodenuncia(idtipodenuncia);
 O   ALTER TABLE ONLY public.denuncia DROP CONSTRAINT denuncia_idtipodenuncia_fkey;
       public          postgres    false    212    3228    262            �           2606    17942 /   detallematerial detallematerial_idmaterial_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.detallematerial
    ADD CONSTRAINT detallematerial_idmaterial_fkey FOREIGN KEY (idmaterial) REFERENCES public.material(idmaterial);
 Y   ALTER TABLE ONLY public.detallematerial DROP CONSTRAINT detallematerial_idmaterial_fkey;
       public          postgres    false    3204    248    214            �           2606    17947 -   detallematerial detallematerial_idpedido_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.detallematerial
    ADD CONSTRAINT detallematerial_idpedido_fkey FOREIGN KEY (idpedido) REFERENCES public.pedido(idpedido);
 W   ALTER TABLE ONLY public.detallematerial DROP CONSTRAINT detallematerial_idpedido_fkey;
       public          postgres    false    3208    252    214            �           2606    17952 )   detallevisita detallevisita_idvisita_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.detallevisita
    ADD CONSTRAINT detallevisita_idvisita_fkey FOREIGN KEY (idvisita) REFERENCES public.visita(idvisita);
 S   ALTER TABLE ONLY public.detallevisita DROP CONSTRAINT detallevisita_idvisita_fkey;
       public          postgres    false    3252    216    274            �           2606    17957 ,   detallevisita detallevisita_idvisitante_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.detallevisita
    ADD CONSTRAINT detallevisita_idvisitante_fkey FOREIGN KEY (idvisitante) REFERENCES public.visitante(idvisitante);
 V   ALTER TABLE ONLY public.detallevisita DROP CONSTRAINT detallevisita_idvisitante_fkey;
       public          postgres    false    216    276    3258            �           2606    17962 '   empleado empleado_idestadoempleado_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.empleado
    ADD CONSTRAINT empleado_idestadoempleado_fkey FOREIGN KEY (idestadoempleado) REFERENCES public.estadoempleado(idestadoempleado);
 Q   ALTER TABLE ONLY public.empleado DROP CONSTRAINT empleado_idestadoempleado_fkey;
       public          postgres    false    218    3186    230            �           2606    17967 %   empleado empleado_idtipoempleado_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.empleado
    ADD CONSTRAINT empleado_idtipoempleado_fkey FOREIGN KEY (idtipoempleado) REFERENCES public.tipoempleado(idtipoempleado);
 O   ALTER TABLE ONLY public.empleado DROP CONSTRAINT empleado_idtipoempleado_fkey;
       public          postgres    false    218    3230    264            �           2606    17972 $   espacio espacio_idestadoespacio_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.espacio
    ADD CONSTRAINT espacio_idestadoespacio_fkey FOREIGN KEY (idestadoespacio) REFERENCES public.estadoespacio(idestadoespacio);
 N   ALTER TABLE ONLY public.espacio DROP CONSTRAINT espacio_idestadoespacio_fkey;
       public          postgres    false    232    3188    220            �           2606    17977 7   historialinventario historialinventario_idmaterial_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.historialinventario
    ADD CONSTRAINT historialinventario_idmaterial_fkey FOREIGN KEY (idmaterial) REFERENCES public.material(idmaterial);
 a   ALTER TABLE ONLY public.historialinventario DROP CONSTRAINT historialinventario_idmaterial_fkey;
       public          postgres    false    3204    248    242            �           2606    26283 6   historialresidente historialresidente_idresidente_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.historialresidente
    ADD CONSTRAINT historialresidente_idresidente_fkey FOREIGN KEY (idresidente) REFERENCES public.residente(idresidente);
 `   ALTER TABLE ONLY public.historialresidente DROP CONSTRAINT historialresidente_idresidente_fkey;
       public          postgres    false    258    281    3214            �           2606    26269 0   historialusuario historialusuario_idusuario_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.historialusuario
    ADD CONSTRAINT historialusuario_idusuario_fkey FOREIGN KEY (idusuario) REFERENCES public.usuario(idusuario);
 Z   ALTER TABLE ONLY public.historialusuario DROP CONSTRAINT historialusuario_idusuario_fkey;
       public          postgres    false    3250    272    279            �           2606    17982 .   imagenesespacio imagenesespacio_idespacio_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.imagenesespacio
    ADD CONSTRAINT imagenesespacio_idespacio_fkey FOREIGN KEY (idespacio) REFERENCES public.espacio(idespacio);
 X   ALTER TABLE ONLY public.imagenesespacio DROP CONSTRAINT imagenesespacio_idespacio_fkey;
       public          postgres    false    244    220    3174            �           2606    17987 "   material material_idcategoria_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.material
    ADD CONSTRAINT material_idcategoria_fkey FOREIGN KEY (idcategoria) REFERENCES public.categoria(idcategoria);
 L   ALTER TABLE ONLY public.material DROP CONSTRAINT material_idcategoria_fkey;
       public          postgres    false    248    3158    210            �           2606    17992    material material_idmarca_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.material
    ADD CONSTRAINT material_idmarca_fkey FOREIGN KEY (idmarca) REFERENCES public.marca(idmarca);
 H   ALTER TABLE ONLY public.material DROP CONSTRAINT material_idmarca_fkey;
       public          postgres    false    248    3202    246            �           2606    17997 %   material material_idunidadmedida_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.material
    ADD CONSTRAINT material_idunidadmedida_fkey FOREIGN KEY (idunidadmedida) REFERENCES public.unidadmedida(idunidadmedida);
 O   ALTER TABLE ONLY public.material DROP CONSTRAINT material_idunidadmedida_fkey;
       public          postgres    false    3238    270    248            �           2606    18002    pedido pedido_idempleado_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.pedido
    ADD CONSTRAINT pedido_idempleado_fkey FOREIGN KEY (idempleado) REFERENCES public.empleado(idempleado);
 G   ALTER TABLE ONLY public.pedido DROP CONSTRAINT pedido_idempleado_fkey;
       public          postgres    false    218    252    3166            �           2606    18007 !   pedido pedido_idestadopedido_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.pedido
    ADD CONSTRAINT pedido_idestadopedido_fkey FOREIGN KEY (idestadopedido) REFERENCES public.estadopedido(idestadopedido);
 K   ALTER TABLE ONLY public.pedido DROP CONSTRAINT pedido_idestadopedido_fkey;
       public          postgres    false    252    3190    234            �           2606    18012    pedido pedido_idusuario_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.pedido
    ADD CONSTRAINT pedido_idusuario_fkey FOREIGN KEY (idusuario) REFERENCES public.usuario(idusuario);
 F   ALTER TABLE ONLY public.pedido DROP CONSTRAINT pedido_idusuario_fkey;
       public          postgres    false    252    272    3250            �           2606    18017 ,   permisousuario permisousuario_idpermiso_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.permisousuario
    ADD CONSTRAINT permisousuario_idpermiso_fkey FOREIGN KEY (idpermiso) REFERENCES public.permiso(idpermiso);
 V   ALTER TABLE ONLY public.permisousuario DROP CONSTRAINT permisousuario_idpermiso_fkey;
       public          postgres    false    3210    256    254            �           2606    18022 0   permisousuario permisousuario_idtipousuario_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.permisousuario
    ADD CONSTRAINT permisousuario_idtipousuario_fkey FOREIGN KEY (idtipousuario) REFERENCES public.tipousuario(idtipousuario);
 Z   ALTER TABLE ONLY public.permisousuario DROP CONSTRAINT permisousuario_idtipousuario_fkey;
       public          postgres    false    3234    256    268            �           2606    18027 *   residente residente_idestadoresidente_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.residente
    ADD CONSTRAINT residente_idestadoresidente_fkey FOREIGN KEY (idestadoresidente) REFERENCES public.estadoresidente(idestadoresidente);
 T   ALTER TABLE ONLY public.residente DROP CONSTRAINT residente_idestadoresidente_fkey;
       public          postgres    false    236    258    3192            �           2606    18032 '   residentecasa residentecasa_idcasa_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.residentecasa
    ADD CONSTRAINT residentecasa_idcasa_fkey FOREIGN KEY (idcasa) REFERENCES public.casa(idcasa);
 Q   ALTER TABLE ONLY public.residentecasa DROP CONSTRAINT residentecasa_idcasa_fkey;
       public          postgres    false    260    208    3154            �           2606    18037 ,   residentecasa residentecasa_idresidente_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.residentecasa
    ADD CONSTRAINT residentecasa_idresidente_fkey FOREIGN KEY (idresidente) REFERENCES public.residente(idresidente);
 V   ALTER TABLE ONLY public.residentecasa DROP CONSTRAINT residentecasa_idresidente_fkey;
       public          postgres    false    3214    258    260            �           2606    18042 +   unidadmedida unidadmedida_idtipounidad_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.unidadmedida
    ADD CONSTRAINT unidadmedida_idtipounidad_fkey FOREIGN KEY (idtipounidad) REFERENCES public.tipounidad(idtipounidad);
 U   ALTER TABLE ONLY public.unidadmedida DROP CONSTRAINT unidadmedida_idtipounidad_fkey;
       public          postgres    false    266    270    3232            �           2606    18047 $   usuario usuario_idestadousuario_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.usuario
    ADD CONSTRAINT usuario_idestadousuario_fkey FOREIGN KEY (idestadousuario) REFERENCES public.estadousuario(idestadousuario);
 N   ALTER TABLE ONLY public.usuario DROP CONSTRAINT usuario_idestadousuario_fkey;
       public          postgres    false    238    3194    272            �           2606    18052 "   usuario usuario_idtipousuario_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.usuario
    ADD CONSTRAINT usuario_idtipousuario_fkey FOREIGN KEY (idtipousuario) REFERENCES public.tipousuario(idtipousuario);
 L   ALTER TABLE ONLY public.usuario DROP CONSTRAINT usuario_idtipousuario_fkey;
       public          postgres    false    268    272    3234            �           2606    18057 !   visita visita_idestadovisita_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.visita
    ADD CONSTRAINT visita_idestadovisita_fkey FOREIGN KEY (idestadovisita) REFERENCES public.estadovisita(idestadovisita);
 K   ALTER TABLE ONLY public.visita DROP CONSTRAINT visita_idestadovisita_fkey;
       public          postgres    false    240    274    3196            �           2606    18062    visita visita_idresidente_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.visita
    ADD CONSTRAINT visita_idresidente_fkey FOREIGN KEY (idresidente) REFERENCES public.residente(idresidente);
 H   ALTER TABLE ONLY public.visita DROP CONSTRAINT visita_idresidente_fkey;
       public          postgres    false    274    258    3214            k   }  x���Q��0����.-�d[v����c���e:ЇP>B�_6�oe�m���ꛛ�����l���>[{9Il9޸}p_�ƅ��p\���kXY���Ԃ���ƍa�C\1N���b�.P'�.�z�32ݮ��VwI'��WIOE�I�@݉vI�d�x����-��-��-��-��qܒ�(�N�_;�.通=I�t�t����H��TŐ�Tt5I�d�Tܒiܒ���[2�[�}��L�L�� 𭞊n&�"i�tH�BMZ�&�5�����-��i�%;��d?�%٫:n�4n�4n���S��������N�t��CM�;C�j2��$�[��Nܒiܒ�!�-�ܒ�8n��'�sl��?�~�����M���������cmu      m     x���Kn�@��t
^@Awϣ{n�dCD�!��۹Ș5�z�+��aD�
�\Ovғ��abz�X�~�/����|}N��yz������~{|>��mz������z{��ϯg�'mN�$pNޜ|I2�48es��y����S��S�o�������Ę���ic�+�Q��T�T:��c'��m�jc'�u������s@b�����K�*.�jp��j��%V3.�Z�p��
�L�z���j_4���< W8\np�4<�����K�.�p�4��pix�!���!.��&�]��O�08\b��p�E��%�XT8\b�p��"�p�E��%֤�K���k}�db--���Z��%�
.�V�p�5��%��Xkp��L���¡[��wH%f��J̤/�K̤,טO̤¡3q8Tb&�J̤��38Tb��&�Hl�M��&8\b����t4���E�O���u=�5E^_��������5:�E��C\�_w���M;�uo�!.|K�ʷ�!.}+�ڷ���߾M����ms���q>����v      o   �  x����n�����Sp�Y�P�V���Md `��Y�Hv/�N�2/�Sd�H��eS�6�>_��.U��PMT[g\�q��κ;�__O���ݯ~�T/��f�����Q����������U���4�s�Y�~h���i�6��Yca�3�c�2�x��}kNM�4�<%�f����8ge����) �������<���ټf��
�<�EL���K����f��󽩌���m����s��u�����n�Z<֌5��`�����­�Qja#J�,��2�p�ڊ���;6Dcu���<�=ߠ�O�_��+r��cl{xj��3`�}V�4�a���}(����ړSs�)���������Zf��9����3�l?֐<�0�E3���7���o/ݦݷ�5� Puo����}sh�$#X�X�����{춧���6ϼ�惊�	�Y��7a�}?�GL
�¢�C��*qNO���z����*���{e����e��%�۳5[h�A�p;ì�k
�q�_�;sB3f���+�]��u�lmUgXy�����i��Bz�Cp�U ��@R�"�0{��^��u��ѡf% ��,��J��,e�gM;���sn���m�崰���&����}r�y�X�4R(��@w�^����0��YSvd� Bz��ⅎ|�R�a�~�a���j��N,����h��$�C-b�#Le�XN�!)��|>�^�v�2%�u!��f����F�e�Oa�k:C�h��~;w�g׬13b�-����N;S����Ka��������-#�
@��9�d�m-΀�..�ጙ���i����M �Š	�� ����ZMY8��y�z�0�Z*����>��O* J�BB0^ܩ�ĵޠ\A�^��yCʂ��Q'Xf�H�y'��}��+8:���#�)8���}��D~�mi5�ѬCl�O��a��F�/Wy����S�)wR2��:wiV�>��9�
�?F�p��{|��!iL �:�t�˨�&x�!=�YeoBT��~a���J�p$э)�G�;K���|��C�s0�xz�N�����zX����v�kr��x�1b�!
]kjcI0o�׺�����;*t&�z�pK:��
�����^�N<��}\R�����sž:4���e��l�k��A�ݢ��`_C��%�Dg��+uq$���ESҒ١���}��$2\gV
	�8'�D�L��Ze��5'�$���4F���Fqi�%� �R�1?����Lt6�7�dûBkH<ē=�~���81��-�Y�An�h��[� �����>�h-�HUxaDE�=�8u
^q�N�`����,���'	�B��x��0��4!kF1	˕C����Y�z8^�����O���ʢ#���K���B��א/U@�_��%<��
!i���_�G�3A���uH�[��4�,�#�u��WZ���R5�sў��B�.q�;�3��1^s�(�;k���r)��x+p��*uH��/�3�e� NI�D��b�7�FzLW����X誒A�4��i=Ok^s���o��;#��Un������ɚZ��S��=�E,�${�T"to�Ӿ=�w�o�i�&��Huu W�d0��~�����i�N9�c�����N��W�Z�����lX��{��E��q�뚰-O�z�Wc`�p��>=��d}��Ĕ�Y�V��K��肼������S���C�?f)	r����Z6����h�����t� ^S�� ��#�V؄�6�fp��I=���XZ�0�gQ}�O��o/���ç�R�?�T,%d���%�������Ԫ~�P}x�5@�E��EY���LQ���U!:�H4�|*g�~�|kW���?��i�j����2�Tu��{3���e�r�HX�+�]�K^���'���	��>�z\)�D�<j�&�;�K���'#�y����?��f4-ռ'^j%�O���f_��ְ7�șF����p2�yG��f�^�! RF      q   �   x���=N1Fk�SB�3��?%��hh��8b%'�Y��8vVZ��h���7�C�
�C�u��$\I�"���t<��9���������p�:w5��f��T�>��i��7�c�x��v	�9�'���5�vH�"r���1�b(H+�Bm�zJ��^(&H�2�?����ԁ�@��N.��ry�R���t85���fD	x�8�6���>���i���o��gX7�0��܏��q_��jE��      s   �   x�5���0g�)�HiiÊP�J�,�� (MK~�����g_���EʓZ��9��(Ŷp�g	VP!+�r�EN�r�y�e���A�E�Wc�����f������y�'1.�r\���a��[�
�>��!}��Zo� %K	�D���:�      u   D   x�3�t,*9�6�4'�X!%U!'3� 3�*��M"9?����499���<.KN�����Լ�D�@� �w�      w     x�m�KN1DמS�&χ�5B�(Ȧ��ȟ`O#8G�b��,���M��겜�����z�v۶��{�+�@�5��	4�3�0�F�y�v���؛���2m���Jm+5��F�_��:SL!�.XJ3z����e�	Ue�"���d���yfD6:��L盛\{>Zv9�2?�~ד�dr���D�����(�?�|(�p�T"1����bei������/*vlQ�+��0���Yr���;�z��Z(5���a�4�/qd�#      y   S   x�=���@��v��;���������T��c�a����IeS���:���dFU�7���OI���X��35�:���'�A�1�      {   .   x�ȹ	 0��X[�a�s3�
d�lJ�RQ{��e���IsiO      }     x�u�Kn�0���)t$� ����A�5�m6#�V�J�A�F�;uQ��X��]�q����F~���\�Yik��Y� ����t����rDT��j*$a</�JȬ&_H���j-�X�ֶ#�`�G�k�y��n�Ֆ�� ���n ��<�UƋ�@t�7����tp����X�'BV"+��h�TBP�RPb�����xȀC,���5p�����*��oƍ[9�F�ԁ�Ծ��f)&0痚�n۪n�fD��H3��)3�'h���&�ۂEP����g$Ve�q����qWIY�uI��$���]���F�½����c�"F���	VRc,oN� ��5H�0)a~z�&�w���E��^M�"���D�g��۲UJ�L�鏣ށ�ރ�:��-���=�70�1��e-%:��e~	lrUA��.��_��x����h��v��+�w[Ӄǚ{ؙcO���P�_�WҚ6�hX{QP��]N�o�y���Vy���=�h*���bO!�����d\
%�*e)T��,��|}%�fI��1P#�         �   x�}�Kj�0��|
���'YU4�v��u�HW���N�3�bU�I��V��Ǐ(��֭�e��F?��y�+T�����y����<�����S$��=���Xz����"[�ؗ�f�0�O.���GDl)���G�P�<��R�:/�4�}�7�^G�8��t��d�]�7ϽjuWaU��Ϗ^2��xfv�ǽ����ЩF޿i�p0�,<���e�r�=S��4I�/��i�      �   8   x�3�J-�,�<�9�ˈ�1�$�,�˘�-3/1'�*1%�˄�%5/5Č���� �&�      �   %   x�3�H�K�L�+I�2�tN�KN�ILI����� ��:      �       x�3�tL.�,K�2�tI-N�S�b���� x��      �   I   x�3�H�K�L�+I�2�JM�H�JLI�2��2�3o��2�t�S((�ON-��2���)M���)����� ��      �   /   x�3�t�,.���L�I�2��O.-HL��2�.-.H�K�rb���� �j      �   9   x�3�t�,.���L�I�2��O.-HL��2�.-.H�K�rL8�R�S��@1z\\\ �;\      �   8   x�3�t�S(�ON-��2�JM�ɬJL��2��3�2�LN�ļ���p� ���      �   &   x�3�tL.�,��2�tI-�HL���,IL������ �|�      �   '   x�3�t�,.���L�I�2�.-.H�K�L������ ��	Y      �   #   x�3�tL.�,K�2�t��K�ɬJL������ o��      �   o   x�e���0�o�� �.����*򩿏���$,|�� '�V�$d�R�e���2��&�ɂ$	�p%�o��BR�_�T�	pV�T ����=�R�Gkx��R�/N>3t      �   a   x�m�1�  ��~��V��o0�����H4���n��1(�yb��(C.m��|J�lG���A����d���4/�^�1�h��(�BL)��*�"~��u      �   �   x�e�;�0��)|���c��g@4)hh�La)�Q���:S<i�f���ѣx�%7����K����?	O'9Y��4i@'�L ����Q�G�Jj��w����[�����K͖C���:674�� k+*      �   C   x�3�43H5174H34O1J��*H�4�2�&[������s�r�DS�L�R��jM�b���� m�      �   6   x�3�tv�u��2����MJ-ʩ�u�I,��2����q���2���vu����� !`      �     x�M�Kn�0D��)|��6x�$rD ��D�4"h��
����z��T�(tV7�"E��"m*��� ���B�@���]�!�7��p��e@�:
U�9Qe�_�E���y1�o���	�
����xEbp6?H��hF���`��&�Z=�xQixp�,{?M�=��=89.�G��90��
ٵ"����K��$��e�4=�|6)�9v&�yh2E�L�*�3 � 8º8������V���{ڎw�`��G�����/�q�?)�j�      �     x�]�MK�@���̇����cA=���[�j#����@cf6��3����4���B��~^3�����D��~��H��,�L�ӸDA����}�:/��e�<���p]��������i��^ݎ�n	
�ъ�Iɨ�fTYш�jTS��8�F��X8:�p,��cI
,���EᨪpT[၃S8�+%�8�h���ñ���(<r��n
���Q��&Q�SP8*82m�����K�R{8�����Y8�+%
G���
G%����#���Z8�������į7��l�K      �   <   x�3�4�4b##C]s]3.cNc��!��)X�Y��I�%�9X�\�Ј+F��� ��&      �   S   x�3�t�),��I-J-�2�t,�/*IL���r�9]R�J�3��L8}KR�2s����ť�E���\f�a�ř%@1z\\\ j.      �   J   x�˱� C��a�K��#�΅_��f���5�VS�:TZ�*�Z8�ܢk��%�G�����������      �     x�u��r�:E��Wx�)$!Ĭ����mw�8��<d0��_ݺ��?v8)W�oT18:����1��N�RG4�Or��`���/��S �X1�	�i@��#@tL���c1�����R����/b~��"PӐ�ab0:DXv��x�ô���Ϻ����6N�1P�z�7��({���:�Og,��g�u7�����U8,�($B0@{2%Ґe;��1o�b'��E\�PB-Y���(�0*�(0)1͢���hk��"u�@��灊*���7UY��,�|1�:�����Z����{1��C٧�U2ov'��5����؉��dB��e�פ"��c���mZ
�OEc��S�6b�&A�7��6�x��S6x�0�H�R%�^��!��[i���������_9
x07���'o�ڟ&V��>X��6��*Z�Q^���k�����!��=��2�jxB,anWó����PYK�Kn�w /��ā�\V�u�,T������l}ĸ����Лw�	rއ/���@� K�<l���,ͤ3�Ƙy��?UP��H�B�d)��9�t)6,���R����
Q�!SR�I���o�G~���O��y���r�uK�L�6��I�水��膎t��[�Z�L�["M��NdLf)���J�cA�S�u��eN{��z�U2Żq�g\���߃��ނ��N�uT|��E�+%�,�,F����wy�h婐���e�p��)g�4K��8���{�{<��E�XR'�hߥ�e��
$ÖMf�����au��c{���W.u�������E�~��WV��L��J��/��A�6ʏ5���n�D�P��$r�:l���Qy��= ��WbTuw��e��=hƠkx��(�������f���l��{�]6��1�z��ؓ�o����zy̏�^��� j���UnQ�#�u5��o��oTj!ϙT�!_���|�q�5����+W/E<�]O���ζc�W�f��"M��iҵ������>==��x�W      �   *   x���  ��w;�'����s�$ͲH��!�eL���U[�      �   4   x�3��M�+I����L�+��2����-�L�J�2�t�,.)-J������� I?�      �   ,   x�3�t�IJ<�13�ˈ�'3� 3�*�˘�)?%5=�+F��� ��
�      �   '   x�3���)�M��2�H-��2�t�))-J����� ��^      �   0   x�3�tL����,.)JL�/�2�tN,N-I�22�t�OIMO����� h�      �   )   x�3�4���,)�/�2�42�����9�9}S��1z\\\ ��	}      �   �  x����r�0���\���pW�cWl=u�NoDD9(
����>B_l���Nݙn�I�}���R�L$���nP�<Ȁ+B��Sh��Q*+�11u��2�3�(��"6�MA��6����)�%�M�m��(6�,B�C[�� �Բգ#��B�@���~��MG��Y�9݌r1��[N�~%F�r1�i��	���h���Q^ QjɹeG��  x�q`��|w2M��̵V�g� ��_[YiӨ��cn�Z��nZ�:�=ۗ��[_���*�9#�Eu�g����J�[���{���;j�''}��O�-�d5ޙ鬽Qs�Z������(�F{��)e��A���jDijש����AZ&1�i�z�����1����N�`J��!nW}c�ӈ�{��%|�v\���/&����kM��� "؋}�>�|�EBO���Ӻ�����B�."�SgJdR�r3[���4dP x��W9!~v���y.�!F��ͳOW���'�Y��A�e�s��2��Yx��g�L���)�5
�.�Q�ԭz���M5W&�QKrH��7����P���K�k��
���/�f9�E�;n{�K��U��~�������OX�Z�m������;����g�"���l/�Y��,՜z��W���h4�)r=_      �   �   x�}�Mn� ���sGl�}��n*e�mHB䀄�3�bT�F��4��703���٧aj�P1̐�$U@g��ma�Ы痃���:��wd�L.��
��$t�w�~^A[��j	?�0���ʎ����[y2y�&��X��5�#�k�DԬQ����l;4L0�`e�U	&���2����a�`�>���isj@���k�X��y�N��)��<t��p SwȲ�NŤr      �   �   x�U��
�0Dϛ��T�4��**
"��KJ�J"�ƃ_oK�a�7�p��-��Ы�%��&���Y6�=���3�����y��'�s3B� ��,�Y*��(�o��_��*M���(}%,Qo*/��yD��'U��N^����=6%;'����T��R��%5      