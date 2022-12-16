// colores
let rojo = "background: #f35252;color: black;";
let naranja = "background: rgb(255 135 65);color: black;";
let amarillo = "background: #eff59a;color: black;";
let verdeC = "background: #bff8c2;color: black;";
let verdeO = "background: #8af18f;color: black;";

// valores estaticos
let totalVentas = document.getElementById("totven").textContent;
let ventasPortmen69 = document.getElementById("portmen69").textContent;
let ventasPortmay69 = document.getElementById("portmay69").textContent;
let ventasaltpost = document.getElementById("altpost").textContent;
let ventasAltPrepa = document.getElementById("altpre").textContent;
let ventasportpre = document.getElementById("portpre").textContent;
let ventasreno = document.getElementById("reno").textContent;
let ventasftth = document.getElementById("ftth").textContent;
let ventasifi = document.getElementById("ifi").textContent;

// valores a comparar
// progreso total
let progreTotalVentas = document.getElementById("progreTotVen").textContent;
let barraProgreTotalVentas = document.getElementById("BarraProgreTotVen");

progreTotal = (progreTotalVentas*100)/totalVentas;

barraProgreTotalVentas.innerHTML = progreTotal.toFixed(1) + "%";

if (progreTotal >= 0 && progreTotal < 20) {
    barraProgreTotalVentas.style="width: "+progreTotal+"%;"+rojo;
}
else if (progreTotal >= 20 && progreTotal < 40) {
    barraProgreTotalVentas.style="width: "+progreTotal+"%;"+naranja;
}
else if (progreTotal >= 40 && progreTotal < 60) {
    barraProgreTotalVentas.style="width: "+progreTotal+"%;"+amarillo;
}
else if (progreTotal >= 60 && progreTotal < 90) {
    barraProgreTotalVentas.style="width: "+progreTotal+"%;"+verdeC;
}
else if (progreTotal >= 90) {
    barraProgreTotalVentas.style="width: "+progreTotal+"%;"+verdeO;
}

// progreso portabilidad menor a 69
let progreportmen69 = document.getElementById("progrevenprotmen69").textContent;
let barraProgreportmen69 = document.getElementById("BarraProgrevenprotmen69");

progportmen69 = (progreportmen69*100)/ventasPortmen69;

barraProgreportmen69.innerHTML = progportmen69.toFixed(1) + "%";

if (progportmen69 >= 0 && progportmen69 < 20) {
    barraProgreportmen69.style="width: "+progportmen69+"%;"+rojo;
}
else if (progportmen69 >= 20 && progportmen69 < 40) {
    barraProgreportmen69.style="width: "+progportmen69+"%;"+naranja;
}
else if (progportmen69 >= 40 && progportmen69 < 60) {
    barraProgreportmen69.style="width: "+progportmen69+"%;"+amarillo;
}
else if (progportmen69 >= 60 && progportmen69 < 90) {
    barraProgreportmen69.style="width: "+progportmen69+"%;"+verdeC;
}
else if (progportmen69 >= 90) {
    barraProgreportmen69.style="width: "+progportmen69+"%;"+verdeO;
}

// progreso portabilidad mayor a 69
let progreportmay69 = document.getElementById("progrevenprotmay69").textContent;
let barraProgreportmay69 = document.getElementById("BarraProgrevenprotmay69");

progportmay69 = (progreportmay69*100)/ventasPortmay69;

barraProgreportmay69.innerHTML = progportmay69.toFixed(1) + "%";

if (progportmay69 >= 0 && progportmay69 < 20) {
    barraProgreportmay69.style="width: "+progportmay69+"%;"+rojo;
}
else if (progportmay69 >= 20 && progportmay69 < 40) {
    barraProgreportmay69.style="width: "+progportmay69+"%;"+naranja;
}
else if (progportmay69 >= 40 && progportmay69 < 60) {
    barraProgreportmay69.style="width: "+progportmay69+"%;"+amarillo;
}
else if (progportmay69 >= 60 && progportmay69 < 90) {
    barraProgreportmay69.style="width: "+progportmay69+"%;"+verdeC;
}
else if (progportmay69 >= 90) {
    barraProgreportmay69.style="width: "+progportmay69+"%;"+verdeO;
}

// progreso altas postpago
let porgrealtpost = document.getElementById("progrevenaltpost").textContent;
let barraporgrealtpost = document.getElementById("Barraprogrevenaltpost");

Paltpostpa = (porgrealtpost*100)/ventasaltpost;

barraporgrealtpost.innerHTML = Paltpostpa.toFixed(1) + "%";

if (Paltpostpa >= 0 && Paltpostpa < 20) {
    barraporgrealtpost.style="width: "+Paltpostpa+"%;"+rojo;
}
else if (Paltpostpa >= 20 && Paltpostpa < 40) {
    barraporgrealtpost.style="width: "+Paltpostpa+"%;"+naranja;
}
else if (Paltpostpa >= 40 && Paltpostpa < 60) {
    barraporgrealtpost.style="width: "+Paltpostpa+"%;"+amarillo;
}
else if (Paltpostpa >= 60 && Paltpostpa < 90) {
    barraporgrealtpost.style="width: "+Paltpostpa+"%;"+verdeC;
}
else if (Paltpostpa >= 90) {
    barraporgrealtpost.style="width: "+Paltpostpa+"%;"+verdeO;
}

// progreso altas prepago
let progreVentasAltPre = document.getElementById("progrevenaltpre").textContent;
let barraProgreVentasAltPre = document.getElementById("BarraProgreVenAltPre");

altPre = (progreVentasAltPre*100)/ventasAltPrepa;

barraProgreVentasAltPre.innerHTML = altPre.toFixed(1) + "%";

if (altPre >= 0 && altPre < 20) {
    barraProgreVentasAltPre.style="width: "+altPre+"%;"+rojo;
}
else if (altPre >= 20 && altPre < 40) {
    barraProgreVentasAltPre.style="width: "+altPre+"%;"+naranja;
}
else if (altPre >= 40 && altPre < 60) {
    barraProgreVentasAltPre.style="width: "+altPre+"%;"+amarillo;
}
else if (altPre >= 60 && altPre < 90) {
    barraProgreVentasAltPre.style="width: "+altPre+"%;"+verdeC;
}
else if (altPre >= 90) {
    barraProgreVentasAltPre.style="width: "+altPre+"%;"+verdeO;
}

// progreso portabilidad prepago
let progreportprepago = document.getElementById("progreportprepa").textContent;
let barraProgreportprepa = document.getElementById("BarraProgreportprepa");

portprepa = (progreportprepago*100)/ventasportpre;

barraProgreportprepa.innerHTML = portprepa.toFixed(1) + "%";

if (portprepa >= 0 && portprepa < 20) {
    barraProgreportprepa.style="width: "+portprepa+"%;"+rojo;
}
else if (portprepa >= 20 && portprepa < 40) {
    barraProgreportprepa.style="width: "+portprepa+"%;"+naranja;
}
else if (portprepa >= 40 && portprepa < 60) {
    barraProgreportprepa.style="width: "+portprepa+"%;"+amarillo;
}
else if (portprepa >= 60 && portprepa < 90) {
    barraProgreportprepa.style="width: "+portprepa+"%;"+verdeC;
}
else if (portprepa >= 90) {
    barraProgreportprepa.style="width: "+portprepa+"%;"+verdeO;
}

// progreso renovacion
let progrecentreno = document.getElementById("progrevenrenova").textContent;
let barraProgrecentreno = document.getElementById("BarraProgrevenrenova");

proventreno = (progrecentreno*100)/ventasreno;

barraProgrecentreno.innerHTML = proventreno.toFixed(1) + "%";

if (proventreno >= 0 && proventreno < 20) {
    barraProgrecentreno.style="width: "+proventreno+"%;"+rojo;
}
else if (proventreno >= 20 && proventreno < 40) {
    barraProgrecentreno.style="width: "+proventreno+"%;"+naranja;
}
else if (proventreno >= 40 && proventreno < 60) {
    barraProgrecentreno.style="width: "+proventreno+"%;"+amarillo;
}
else if (proventreno >= 60 && proventreno < 90) {
    barraProgrecentreno.style="width: "+proventreno+"%;"+verdeC;
}
else if (proventreno >= 90) {
    barraProgrecentreno.style="width: "+proventreno+"%;"+verdeO;
}

// progreso fija ftth
let progrefijaftth = document.getElementById("progrevenfijaftth").textContent;
let barraProgrefijaftth = document.getElementById("BarraProgrevenfijaftth");

provenfijaftth = (progrefijaftth*100)/ventasftth;

barraProgrefijaftth.innerHTML = provenfijaftth.toFixed(1) + "%";

if (provenfijaftth >= 0 && provenfijaftth < 20) {
    barraProgrefijaftth.style="width: "+provenfijaftth+"%;"+rojo;
}
else if (provenfijaftth >= 20 && provenfijaftth < 40) {
    barraProgrefijaftth.style="width: "+provenfijaftth+"%;"+naranja;
}
else if (provenfijaftth >= 40 && provenfijaftth < 60) {
    barraProgrefijaftth.style="width: "+provenfijaftth+"%;"+amarillo;
}
else if (provenfijaftth >= 60 && provenfijaftth < 90) {
    barraProgrefijaftth.style="width: "+provenfijaftth+"%;"+verdeC;
}
else if (provenfijaftth >= 90) {
    barraProgrefijaftth.style="width: "+provenfijaftth+"%;"+verdeO;
}

// progreso fija ifi
let progrefijaifi = document.getElementById("progrevenfijaifi").textContent;
let barraProgrefijaifi = document.getElementById("BarraProgrevenfijaifi");

provenfijaifi = (progrefijaifi*100)/ventasifi;

barraProgrefijaifi.innerHTML = provenfijaifi.toFixed(1) + "%";

if (provenfijaifi >= 0 && provenfijaifi < 20) {
    barraProgrefijaifi.style="width: "+provenfijaifi+"%;"+rojo;
}
else if (provenfijaifi >= 20 && provenfijaifi < 40) {
    barraProgrefijaifi.style="width: "+provenfijaifi+"%;"+naranja;
}
else if (provenfijaifi >= 40 && provenfijaifi < 60) {
    barraProgrefijaifi.style="width: "+provenfijaifi+"%;"+amarillo;
}
else if (provenfijaifi >= 60 && provenfijaifi < 90) {
    barraProgrefijaifi.style="width: "+provenfijaifi+"%;"+verdeC;
}
else if (provenfijaifi >= 90) {
    barraProgrefijaifi.style="width: "+provenfijaifi+"%;"+verdeO;
}
