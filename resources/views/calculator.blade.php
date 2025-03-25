<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>TEST TECHNIQUE Calculatrice INVENTIV IT</title>
    <meta name="description" content="Calculatrice en ligne INVENTIV IT">
    <meta name="keywords" content="calculatrice,  en ligne, rapide, interactive">
    <meta name="author" content="YoDEVMO">
    <link rel="icon" type="image/png" href="https://cdn-icons-png.flaticon.com/512/1828/1828817.png">
    {{-- PWA (Progressive Web App) link --}}
    <link rel="manifest" href="{{ asset('manifest.webmanifest') }}">
    <meta name="theme-color" content="#f1a33c">


    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        #calculatrice {
            background: #1e1e1e;
            padding: 20px;
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.5);
            width: 390px;
            color: white;
        }
        h1 {
            text-align: center;
            margin-bottom: 10px;
            font-weight: 600;
        }
        .affichage {
            background: transparent;
            border: none;
            color: white;
            font-size: 36px;
            text-align: right;
            width: 100%;
            margin-bottom: 10px;
            padding: 10px;
            box-sizing: border-box;
        }
        .grille {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
        }
        .btn {
            padding: 20px;
            font-size: 20px;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: background 0.2s;
        }
        .btn-fonction {
            background: #555;
            color: white;
        }
        .btn-fonction:hover {
            background: #666;
        }
        .btn-operateur {
            background: #f1a33c;
            color: white;
        }
        .btn-operateur:hover {
            background: #ffb347;
        }
        .btn-chiffre {
            background: #2a2a2a;
            color: white;
        }
        .btn-chiffre:hover {
            background: #444;
        }
        .btn-zero {
            grid-column: span 2;
        }
        .chargement {
            text-align: center;
            font-size: 14px;
            color: #ccc;
            margin-top: 10px;
        }
        .resultat-animation {
            animation: pop 0.4s ease-in-out;
        }
        @keyframes pop {
            0% {
                transform: scale(0.9);
                opacity: 0.7;
            }
            50% {
                transform: scale(1.1);
                opacity: 1;
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }
    </style>
</head>
<body>
<div id="app">
    <div id="calculatrice">
        <h1>Calculatrice INVENTIV IT</h1>
        <input type="text" class="affichage" :value="affichage" :class="{ 'resultat-animation': resultatAnime }" disabled>
        <div class="grille">
            <button class="btn btn-fonction" @click="reset">AC</button>
            <button class="btn btn-fonction" disabled>+/-</button>
            <button class="btn btn-fonction" disabled>%</button>
            <button class="btn btn-operateur" @click="setOperation('divide')">÷</button>

            <button class="btn btn-chiffre" @click="ajouter('7')">7</button>
            <button class="btn btn-chiffre" @click="ajouter('8')">8</button>
            <button class="btn btn-chiffre" @click="ajouter('9')">9</button>
            <button class="btn btn-operateur" @click="setOperation('multiply')">×</button>

            <button class="btn btn-chiffre" @click="ajouter('4')">4</button>
            <button class="btn btn-chiffre" @click="ajouter('5')">5</button>
            <button class="btn btn-chiffre" @click="ajouter('6')">6</button>
            <button class="btn btn-operateur" @click="setOperation('subtract')">−</button>

            <button class="btn btn-chiffre" @click="ajouter('1')">1</button>
            <button class="btn btn-chiffre" @click="ajouter('2')">2</button>
            <button class="btn btn-chiffre" @click="ajouter('3')">3</button>
            <button class="btn btn-operateur" @click="setOperation('add')">+</button>

            <button class="btn btn-chiffre btn-zero" @click="ajouter('0')">0</button>
            <button class="btn btn-chiffre" @click="ajouter('.')">.</button>
            <button class="btn btn-operateur" @click="calculer">=</button>
        </div>
        <div class="chargement" v-if="chargement">Calcul en cours...</div>
    </div>
</div>
<script>
    const { createApp } = Vue;

    createApp({
        data() {
            return {
                nombre1: '',
                nombre2: '',
                operation: null,
                affichage: '',
                chargement: false,
                resultatAnime: false
            };
        },
        methods: {
            ajouter(valeur) {
                if (!this.operation) {
                    this.nombre1 += valeur;
                    this.affichage = this.nombre1;
                } else {
                    this.nombre2 += valeur;
                    this.affichage = this.nombre2;
                }
            },
            setOperation(op) {
                if (this.nombre1 !== '') {
                    this.operation = op;
                    this.affichage = '';
                }
            },
            reset() {
                this.nombre1 = '';
                this.nombre2 = '';
                this.operation = null;
                this.affichage = '';
                this.resultatAnime = false;
            },
            async calculer() {
                if (this.nombre1 === '' || this.nombre2 === '' || !this.operation) return;
                this.chargement = true;
                this.resultatAnime = false;
                try {
                    const response = await fetch("{{ route('calculator.calculate') }}", {
                        method: "POST",
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            number1: parseFloat(this.nombre1),
                            number2: parseFloat(this.nombre2),
                            operation: this.operation
                        })
                    });
                    const data = await response.json();
                    this.affichage = data.result ?? 'Erreur';
                    this.resultatAnime = true;
                } catch (e) {
                    this.affichage = 'Erreur serveur';
                } finally {
                    this.chargement = false;
                    this.nombre1 = this.affichage;
                    this.nombre2 = '';
                    this.operation = null;
                    setTimeout(() => this.resultatAnime = false, 600);
                }
            }
        }
    }).mount("#app");
</script>
</body>
</html>
