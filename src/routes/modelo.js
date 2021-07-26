const express = require("express");
const router = express.Router();
const pool = require("../database");
const request = require("request");
const HOST = "http://localhost/HeroJS/APIHERO/";
const fetch = require("node-fetch");


router.get("/", async (req, res) => {
    const resModelo = await fetch(HOST + "modelocontroller.php");
    const modelos = await resModelo.json();
    const resMarca = await fetch(HOST + "marcacontroller.php");
    const marcas = await resMarca.json();
    res.render("inventario/modelo/modelo", { modelos, marcas });
  });
  
  router.post("/guardarmodelo", (req, res) => {
    let modelo = {
      nombremodelo: req.body.nombremodelo,
      idmarca: req.body.idmarca,
    };
    request.post(
      HOST + "/modelocontroller.php",
      { form: modelo, json: true },
      (err, r) => {
        if (err) {
          console.log(err);
        } else {
          if ((r.status = 1)) {
            console.log(r.body);
  
            res.redirect("/modelo/");
          } else {
            res.redirect("/modelo/");
          }
        }
      }
    );
  });
  
  router.get("/editarmodelo/:id", async (req, res) => {
    const { id } = req.params;
  
    const resModelo = await fetch(HOST + "modelocontroller.php?id=" + id);
    const modelo = await resModelo.json();
    const resMarca = await fetch(HOST + "marcacontroller.php");
    const marcas = await resMarca.json();
  
    console.log(modelo);
    console.log(marcas);
    res.render("inventario/modelo/editarmodelo", { modelo, marcas });
  });
  
  router.post("/actualizarmodelo", (req, response) => {
    let modelo = {
      nombremodelo: req.body.nombremodelo,
      idmarca: req.body.idmarca,
      id: req.body.id,
      status : req.body.status
    };
    console.log(modelo);
    request(
      {
        method: "PUT",
        url: "http://localhost/HeroJS/APIHERO/modelocontroller.php",
        body: modelo,
        json: true,
        headers: {
          "User-Agent": "request",
        },
      },
      (err, res, body) => {
        if (err) {
          console.log(err);
        }
        if (res) {
          console.log(body);
          response.redirect("/modelo/");
        }
      }
    );
  });
  
  router.get("/eliminarmodelo/", async (req, response) => {
    const { id } = req.params;
    const resModelo = await fetch(HOST + "modelocontroller.php?id=" + id);
    const modelo = await resModelo.json();
    const modeloEliminar = {
      id: modelo.modelo.id,
      nombremodelo: modelo.modelo.modelo,
      idmarca: modelo.modelo.idmarca,
      estatus: 0,
    };
    console.log(modeloEliminar);
    request(
      {
        method: "PUT",
        url: "http://localhost/HeroJS/APIHERO/modelocontroller.php",
        body: modeloEliminar,
        json: true,
        headers: {
          "User-Agent": "request",
        },
      },
      (err, res, body) => {
        if (err) {
          console.log(err);
        }
        if (res) {
          console.log(body);
          response.redirect("/modelo/");
        }
      }
    );
    
  });

module.exports = router;