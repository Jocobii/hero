const express = require("express");
const router = express.Router();
const request = require("request");
const HOST = "http://localhost/HeroJS/APIHERO/";
const fetch = require("node-fetch");

router.get("/", async (req, res) => {
  const resMarca = await fetch(HOST + "marcacontroller.php");
  const marcas = await resMarca.json();

  res.render("inventario/marca/marca", { marcas });
});

router.get("/editarmarca/:id", async (req, res) => {
  const { id } = req.params;

  const resMarca = await fetch(HOST + "marcacontroller.php?id=" + id);
  const marca = await resMarca.json();

  console.log(marca);

  res.render("inventario/marca/editarmarca", { marca });
});

router.get("/eliminarmarca/:id", async (req, response) => {
  const { id } = req.params;

  const resMarca = await fetch(HOST + "marcacontroller.php?id=" + id);
  const marca = await resMarca.json();
  const marcaEliminar = {
    id: marca.marca.id,
    nombremarca: marca.marca.Nombre,
    estatus: 0,
  };

  request(
    {
      method: "PUT",
      url: "http://localhost/HeroJS/APIHERO/marcacontroller.php",
      body: marcaEliminar,
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
        response.redirect("/marca/");
      }
    }
  );
});

router.post("/actualizarmarca", (req, response) => {
  let marca = {
    nombremarca: req.body.nombremarca,
    id: req.body.id,
    estatus: req.body.estatus,
  };
  request(
    {
      method: "PUT",
      url: "http://localhost/HeroJS/APIHERO/marcacontroller.php",
      body: marca,
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
        response.redirect("/marca/");
      }
    }
  );
});

router.post("/marca/guardarmarca", (req, res) => {
  let marca = {
    nombremarca: req.body.nombremarca,
  };
  console.log(marca);
  request.post(
    HOST + "/marcacontroller.php",
    { form: marca, json: true },
    (err, r) => {
      if (err) {
        console.log(err);
      } else {
        if ((r.status = 1)) {
          console.log(r.body);
          //exito
          res.redirect("/marca/");
        } else {
          //error
          res.redirect("/marca/");
        }
      }
    }
  );
});

module.exports = router;