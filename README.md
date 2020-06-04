Sopa de letras

Los puntos del 1 al 6, 10 y 11 están todos hechos.
Los puntos 7, 8 y 9 no están hechos.

Para comprobar el 11 es un poco complicado, ya que las palabras se asignan de manera random
he dejado un comentario en las líneas 161 y 183 de main.php donde explico como es posible que las
palabras se solapen si comparten alguna letra en común

para ver las palabras a simple vista sin tener que buscarlas hay que:
comentar las lineas :165 y 187
y descomentar las lineas: 166 y 188

La app ha de:
1. Disposar d'un arxiu amb paraules (1 paraula per línia).
2. Pàgina inicial per triar nom del jugador, el nombre de files, columnes i paraules a incloure a
la partida.
3. Mostrar la partida en una taula del tamany indicat a la pàgina inicial.
4. Triar aleatòriament les paraules de l'arxiu i col·locar-les al taulell de joc també de forma
aleatòria (inicialment no importa solapament).
5. Omplir les cel·les sense lletra amb una lletra aleatòria (color negre).
6. Permetre que les paraules es puguin disposar de forma vertical o horitzontal aleatòriament.
7. Al clicar sobre una lletra, si correspon a una paraula, posar el fons de color.
8. Posar un comptador d’intents i de lletres descobertes.
9. Quan has descobert totes les lletres de paraules, acabar partida, felicitar usuari, i posar el seu
nom en un rànking. Cal inventar un sistema de puntuació, per exemple:
punts = (total de lletres destapades) – (total d’intents)
10. Fer que les paraules no es puguin solapar al taulell.
11. (pel 10) que algunes paraules es solapin (vertical-horitzontal) si tenen alguna lletra en comú.

