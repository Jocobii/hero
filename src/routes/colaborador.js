const express = require('express');
const router = express.Router();
const request = require('request');
const HOST = 'http://localhost/HeroJS/APIHERO/';
const fetch = require('node-fetch');
const request2 = require('request-promise-native');

/**
 * direccion relativa de esta ruta:
 * localhost:4000/colaborador 
 * 
 * De alli se complementan las que se declararon aqui
 * Ejemplo:
 * 1- /equipo
 * 2- /editar/id
 * 
 * Ejemplo de ruta absoluta
 * localhost:4000/colaborador/equipo
 */
//-----------------------------------------------------------//



router.get('/', async (req, res) => {

    /**
     * Se envia la peticion al API para traer los colaboradores,
     * la cual regresa una promesa que guardaremos en `resColaborador`
     */

    const resColaborador = await fetch(HOST + 'colaboradorcontroller.php');
    
    /**
     * Convertimos la respuesta a formato json y lo guardamos en `colaboradores`
     */
    
    //-- Este proceso se repite con todos los siguientes controladores ---


    const colaboradores = await resColaborador.json();
    
    const resSede = await fetch(HOST + 'sedecontroller.php');
    const sedes = await resSede.json();

    const resEquipo = await fetch(HOST + 'equipocontroller.php');
    const equipos = await resEquipo.json();
    
    const resPuesto = await fetch(HOST + 'puestocontroller.php');
    const puestos = await resPuesto.json();


    /**
     * Una vez que tenemos los datos se los pasamos a la vista
     */
    res.render('colaborador/index', { colaboradores, sedes, equipos, puestos });
});


/**
 * Desplegar los datos de un colaborador
 * recibimos el id y lo guardamos en una constante
 * De alli hacemos una peticion con ese id almacenado.
 */
router.get('/perfil/:id', async (req, res) => {

    const { id } = req.params;
    const resColaborador = await fetch(HOST + 'colaboradorcontroller.php?id=' + id);
    const colaborador = await resColaborador.json();
    const resUsuarios = await fetch(HOST + 'tipousuariocontroller.php');
    const usuarios = await resUsuarios.json();
    res.render('colaborador/perfil', { colaborador, usuarios });

});


router.post('/guardarcolaborador', (req, res) => {
    /**
     *  Recibimos los datos del formulario  y  
     * construimos el objeto colaborador con los datos recibios desde la vista
     */
    let colaborador = {
        "nombre": req.body.nombre,
        "paterno": req.body.paterno,
        "materno": req.body.materno,
        "numservidor": req.body.numservidor,
        "fecha": req.body.fecha,
        "email": req.body.email,
        "comodato": req.body.comodato,
        "sede": req.body.sede,
        "equipo": req.body.equipo,
        "puesto": req.body.puesto,
        "celular": req.body.celular,
        "shortel": req.body.shortel
    };
    //Imprimimos el estado actual del objeto (opcional)
    console.log(colaborador);
    
    /**
     * Una vez construido el colaborador realizamos una peticion post
     * pasandole el controlador, formato y el objeto y tipo
     */
    request.post(HOST + '/colaboradorcontroller.php', { form: colaborador, json: true }, (err, r) => {
        if (err) {
            console.log(err);
        } else {
            res.redirect('/colaborador/');
        }
    })
});

/**
 * Recibimos los datos del formulario  y construimos al colaborador
 */

router.put('/actualizarcolaborador', (req, res) => {
    let colaborador = {
        "nombre": req.body.nombre,
        "paterno": req.body.paterno,
        "materno": req.body.materno,
        "numservidor": req.body.numservidor,
        "fecha": req.body.fecha,
        "email": req.body.email,
        "comodato": req.body.comodato,
        "sede": req.body.sede,
        "equipo": req.body.equipo,
        "puesto": req.body.puesto
    };

    //Imprimimos el estado actual del objeto (opcional)
    console.log(colaborador);

    /**
     * Realizamos una petiticon PUT
     * le pasamos el controlador, formato y el objeto y tipo
     */
    request.put(HOST + '/colaboradorcontroller.php', { form: colaborador, json: true }, (err, r) => {
        if (err) {
            console.log(err);
        } else {
            res.redirect('/colaborador/');
        }
    })

});

router.get('/editar/:id', async (req, res) => {

    const { id } = req.params;
    const resColaborador = await fetch(HOST + 'colaboradorcontroller.php?id=' + id);
    const colaborador = await resColaborador.json();

    const resSede = await fetch(HOST + 'sedecontroller.php');
    const sedes = await resSede.json();

    const resEquipo = await fetch(HOST + 'equipocontroller.php');
    const equipos = await resEquipo.json();

    const resPuesto = await fetch(HOST + 'puestocontroller.php');
    const puestos = await resPuesto.json();

    const resArea = await fetch(HOST + 'areacontroller.php');
    const areas = await resArea.json();

    const resUsuario = await fetch(HOST + 'tipousuariocontroller.php');
    const usuarios = await resUsuario.json();
    console.log(colaborador)
    res.render('colaborador/editar', { colaborador, sedes, equipos, puestos, areas , usuarios});
});


router.post('/editar/guardarusuario/:id', (req, res) => {
    const { isd } = req.params;
    const usuario = {
        'nombreusuario': req.body.nombreusuario,
        'password': req.body.password,
        'colaborador': req.body.colaborador,
        'tipo':req.body.tipo
    }
    console.log(usuario)
    request.post(HOST + '/usuariocontroller.php', { form: usuario, json: true }, (err, r) => {
        if (err) {
            console.log(err);
        } else {
            res.redirect('/colaborador/editar/:id');
        }
    })
});



router.get('/equipo', async (req, res) => {

    const resEquipo = await fetch(HOST + 'equipocontroller.php');

    const equipos = await resEquipo.json();

    console.log(equipos);
    res.render('colaborador/equipo', { equipos });
});

router.get('/sede', async (req, res) => {

    const resSede = await fetch(HOST + 'sedecontroller.php');


    const sedes = await resSede.json();

    console.log(sedes);
    res.render('colaborador/sede', { sedes});
});



/**
 * Recibimos los datos del formulario  y construimos a la sede
 */

router.post('/sede/guardarsede', (req, res) => {
    const sede = {
        'codsede': req.body.codigosede,
        'nombre': req.body.nombresede,
        'calle': req.body.calle,
        'numext':req.body.numext,
        'numint':req.body.numint,
        'colonia':req.body.colonia,
        'postal':req.body.postal,
        'ciudad':req.body.ciudad,
        'estado':req.body.estado,
        'pais':req.body.pais,
        'telefono':req.body.telefono
    }

    //Imprimimos el estado actual del objeto (opcional)
    console.log(sede)

    /**
     * Realizamos una petiticon POST
     * le pasamos el controlador, formato y el objeto y tipo
     */
    request.post(HOST + 'sedecontroller.php', { form: sede, json: true }, (err, r) => {
        if (err) {
            console.log(err);
        } else {
            res.redirect('/colaborador/sede/');
        }
    })
});


/**
 * Querido Programador: 
 * Cuando escribi este codigo, solo dios y yo 
 * sabiamos como funcionaba,
 * Ahora, solo dios lo sabe!.
 * 
 * A si que si esta tratando de 'optimizar',
 * esta rutina y fracasa (seguramente),
 * por favor, incremente el siguiente contador
 * como advertencia
 * para el siguiente colega
 * 
 * total_horas_perdidas_aqui = 20 horas
 */

module.exports = router;