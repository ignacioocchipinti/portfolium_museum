



let myWidth = 1280;
let myHeight = 720;
let numeroDeEscena = 1;

// imagenes escena 1
let bg_escena_1;
let edificio_escena1;
let personaje;

// imagenes escena 2
let bg_escena_2;

// imagenes sala 1
let bg_sala_1;
let obra1_s1;

// letiables de movimiento e1
let posXpersonajeE1 = 80;
let posYpersonajeE1 = 580;
let velocidadPersonaje = 10;

// letiables de movimiento e2
let posXpersonajeE2 = 175;
let posYpersonajeE2 = 360;

// variables de escena

//  ======================================================================================================================= setup
function setup() {


    var canvas = createCanvas(myWidth, myHeight);
    //canvas.parent('sketch-holder');
    frameRate(30);
    imageMode(CENTER);

}

//  ======================================================================================================================= pre-load
function preload() {

    //  ================================================================================ load imgs escena1
    bg_escena_1 = loadImage('assets/escena_1/bg_escena1.jpg');
    edificio_escena1 = loadImage('assets/escena_1/edificio_escena1.png');
    personaje = loadImage('assets/escena_1/Pj.png');

    //  ================================================================================ load imgs escena2
    bg_escena_2 = loadImage('assets/escena_2/bg_escena2.jpg');

    //  ================================================================================ load imgs sala 1
    bg_sala_1 = loadImage('assets/sala_1/bg_sala_1.jpg');
    obra1_s1 = loadImage('assets/sala_1/obras_subidas/20220121_202409.jpg');

}

//  ======================================================================================================================= draw
function draw() {

    if (windowWidth > 1200 && windowHeight > 700) {


        switch (numeroDeEscena) {
            case 1:
                escena1();
                break;
            case 2:
                escena2();
                break;
            case 3:
                sala1();
                break;
        }

        console.log('nro de escena: ' + numeroDeEscena); //545 595


    }
    else {
        avisoTamañoDePantalla();
    }

}

//  ======================================================================================================================= escena1

function escena1() {
    //  ================================================================================ keyPressed escena1
    if (keyIsPressed) {
        if (keyCode == LEFT_ARROW) {
            posXpersonajeE1 = posXpersonajeE1 - velocidadPersonaje;
            if (posXpersonajeE1 < 0) {
                posXpersonajeE1 = width;
            }
        } else if (keyCode == RIGHT_ARROW) {
            posXpersonajeE1 = posXpersonajeE1 + velocidadPersonaje;
            if (posXpersonajeE1 > width) {
                posXpersonajeE1 = 0;
            }
        }
        else if (keyCode == UP_ARROW) {
            posYpersonajeE1 = posYpersonajeE1 - velocidadPersonaje;
            if (posYpersonajeE1 < 565) {
                posYpersonajeE1 = 565;
            }
        }
        else if (keyCode == DOWN_ARROW) {
            posYpersonajeE1 = posYpersonajeE1 + velocidadPersonaje;
            if (posYpersonajeE1 > height - 50) {
                posYpersonajeE1 = height - 50;
            }
        }
        

    }

    //  ================================================================================ draw de imgs
    image(bg_escena_1, width / 2, height / 2, myWidth, myHeight);
    image(edificio_escena1, width / 2, height / 2, myWidth, myHeight);
    image(personaje, posXpersonajeE1, posYpersonajeE1, 100, 100);

    // ================================================================================ entrada al museo
    if (posXpersonajeE1 > 545 && posXpersonajeE1 < 715 && posYpersonajeE1 < 575) {
        numeroDeEscena = 2;
    }
}




//  ======================================================================================================================= escena2
function escena2() {

    

    //  ================================================================================ keyPressed escena1
    if (keyIsPressed) {
        if (key == 'a') {
            posXpersonajeE2 = posXpersonajeE2 - velocidadPersonaje;
            if (posXpersonajeE2 < 134) {
                posXpersonajeE2 = 134;
            }
        } else if (keyCode == RIGHT_ARROW) {
            posXpersonajeE2 = posXpersonajeE2 + velocidadPersonaje;
            if (posXpersonajeE2 > 1145) {
                posXpersonajeE2 = 1145;
            }
        }
        else if (keyCode == UP_ARROW) {
            posYpersonajeE2 = posYpersonajeE2 - velocidadPersonaje;
            if (posYpersonajeE2 < 105) {
                posYpersonajeE2 = 105;
            }
        }
        else if (keyCode == DOWN_ARROW) {
            posYpersonajeE2 = posYpersonajeE2 + velocidadPersonaje;
            if (posYpersonajeE2 > 540) {
                posYpersonajeE2 = 540;
            }
        }
    }

    if(posXpersonajeE2 > 565 && posXpersonajeE2 < 715 && posYpersonajeE2 < 175)
    {
        numeroDeEscena = 3;
    }

    image(bg_escena_2, width / 2, height / 2, myWidth, myHeight);
    image(personaje, posXpersonajeE2, posYpersonajeE2, 100, 100);
    console.log(posXpersonajeE2, posYpersonajeE2);

}

//  ======================================================================================================================= sala1
function sala1() {

    image(bg_sala_1, width / 2, height / 2, myWidth, myHeight);
    image(obra1_s1, width / 2, height / 2 - 80, 300, 300);
    image(obra1_s1, width / 4, height / 2 - 80, 300, 100);

    if (keyIsPressed) {
        if (key == 'b' || key == 'B') {
            numeroDeEscena = 2;
        }
    
}
}



//  ======================================================================================================================= aviso tamaño de pantalla
function avisoTamañoDePantalla() {

    myWidth = windowWidth;
    myHeight = windowHeight;
    let aviso = "Esta aplicación solo funciona con pantallas\n con un resolución mínima de 1200x700px";
    background(180);
    fill(255);
    textSize(windowWidth / 30);
    text(aviso, myWidth / 2, myHeight / 2);
}
