# -*- coding: latin-1 -*-
import numpy
from numpy import random
wilaya = numpy.array(
    [
        "Adrar",
"Chlef",
"Laghouat",
"Oum El Bouaghi",
"Batna",
"Béjaïa",
"Biskra",
"Béchar",
"Blida",
"Bouira",
"Tamanrasset",
"Tébessa",
"Tlemcen",
"Tiaret",
"Tizi Ouzou",
"Alger",
"Djelfa",
"Jijel",
"Sétif",
"Saïda",
"Skikda",
"Sidi Bel Abbès",
"Annaba",
"Guelma",
"Constantine",
"Médéa",
"Mostaganem",
"M'Sila",
"Mascara",
"Ouargla",
"Oran",
"El Bayadh",
"Illizi",
"Bordj Bou Arreridj",
"Boumerdès",
"El Tarf",
"Tindouf",
"Tissemsilt",
"El Oued",
"Khenchela",
"Souk Ahras",
"Tipaza",
"Mila",
"Aïn Defla",
"Naâma",
"Aïn Témouchent",
"Ghardaïa",
"Relizane",

    ]
)
f = open("wilayaprice.txt", "a")
for w1 in wilaya:
    for w2 in wilaya:
        if(w1==w2):
            f.write(w1+","+w2+",500\n")
        else:
            x = random.randint(15)
            prix = 1000 + 100*x
            f.write(w1+","+w2+","+str(prix)+"\n")
            
f.close()