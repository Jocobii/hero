const express = require("express");
const router = express.Router();
const request = require("request");
const HOST = "http://localhost/HeroJS/APIHERO/";
const fetch = require("node-fetch");


router.get("/", async (req, res) => {
  const resInventario = await fetch(HOST + "inventariocontroller.php");
  const inventario = await resInventario.json();

  const resTipoDispositivo = await fetch(
    HOST + "tipodispositivocontroller.php"
  );
  const tipoDispositivo = await resTipoDispositivo.json();

  const resModelo = await fetch(HOST + "modelocontroller.php");
  const modelos = await resModelo.json();

  const resSede = await fetch(HOST + "sedecontroller.php");
  const sedes = await resSede.json();

  res.render("inventario/inventario", { inventario, tipoDispositivo, sedes });
});

router.get("/stock", async (req, res) => {
  const resStock = await fetch(HOST + "stockcontroller.php");
  const stock = await resStock.json();

  const resTipoDispositivo = await fetch(
    HOST + "tipodispositivocontroller.php"
  );
  const tipoDispositivo = await resTipoDispositivo.json();

  const resModelo = await fetch(HOST + "modelocontroller.php");
  const modelos = await resModelo.json();

  const resSede = await fetch(HOST + "sedecontroller.php");
  const sede = await resSede.json();
  console.log(stock);
  res.render("inventario/stock", { stock, tipoDispositivo, modelos, sede });
});

router.get("/stock/asignar/:id", async (req, res) => {
  const { id } = req.params;

  const resStock = await fetch(HOST + "dispositivoscontroller.php?id=" + id);
  const stock = await resStock.json();

  console.log(stock);

  res.render("inventario/asignar", { stock });
});

router.post("/stock/guardardispositivo", (req, res) => {
  let dispositivo = {
    descripcion: req.body.descripcion,
    serie: req.body.serie,
    procesador: req.body.procesador,
    memoria: req.body.memoria,
    almacenamiento: req.body.almacenamiento,
    resolucion: req.body.resolucion,
    puertos: req.body.puertos,
    tipo: req.body.tipo,
    modelo: req.body.modelo,
    estado: req.body.estado,
    codservicio: req.body.codservicio,
    precio: req.body.precio,
    estador: req.body.estador,
    usuariog: req.body.usuariog,
    sede: req.body.sede,
  };
  console.log(dispositivo)
  request.post(
    HOST + "/dispositivoscontroller.php",
    { form: dispositivo, json: true },
    (err, r) => {
      if (err) {
        console.log(err);
      } else {
        if ((r.status = 1)) {
          console.log(r.body);

          res.redirect("/inventario/stock");
        } else {
          res.redirect("/inventario/stock");
        }
      }
    }
  );
});

module.exports = router;
