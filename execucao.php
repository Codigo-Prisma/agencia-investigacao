<?php
require_once('modelo/Player.php');
require_once('modelo/InvCampo.php');
require_once('modelo/InvMedium.php');
require_once('modelo/InvParanormal.php');
require_once('modelo/Itens.php');
require_once('modelo/Entidade.php');
require_once('modelo/Local.php');
require_once('modelo/Caso.php');

function Main(){
    escritaLenta("Vc Gostaria de iniciar do começo? (S/N): ");
    $resp = readline();
    if (strtoupper($resp) === "S") {
        escritaLenta("Iniciando do começo...\n");
        Introducao();
        Jogo();
    } else {
        escritaLenta("\n\nContinuando de onde parou...\n");
        Jogo();
    }
}
function Jogo() {
    escritaLenta("Abrindo o sistema de investigação...\n",50);

    // ----------------- Criação de Investigadores, Itens e Entidades -------------------

    $Investigadores = array(
        new InvCampo("Agente 1", 100.0),
        new InvMedium("Agente 2", 150.0),
        new InvParanormal("Agente 3", 200.0)
    );

    $Itens = array(
        new Itens("Item 1", "Descrição do Item 1", 50.0, 1),
        new Itens("Item 2", "Descrição do Item 2", 75.0, 2),
        new Itens("Item 3", "Descrição do Item 3", 100.0, 3)
    );

    $Evidencias = [
        ["Rastros de mãos", 1],
        ["Rastros de sangue", 1],
        ["Baixa temperatura", 1],
        ["Objetos voando", 2],
        ["Nivel 5 de EMF", 2],
        ["Som de passos", 2],
        ["Tabuleiro Ouija", 3],
        ["Sprit-Box", 3],
        ["Escrita fantasma", 3]
    ];

    $Entidades = array(
        new Entidade("Fantasma", "Fantasma simples e comum, geralmente ligado ao local onde morreu ou a um evento marcante.", array($Evidencias[0], $Evidencias[1], $Evidencias[2]), 1),
        new Entidade("Poltergeist", "Entidade agressiva conhecida por manipular objetos, causar perturbações físicas e produzir atividade intensa no ambiente.", array($Evidencias[3], $Evidencias[4], $Evidencias[5]), 7),
        new Entidade("Banshee", "Espírito associado a manifestações sonoras e lamentos, tornando-se mais ativo quando percebe a presença de pessoas próximas.", array($Evidencias[5], $Evidencias[7], $Evidencias[8]), 5),
        new Entidade("Demonio", "Entidade extremamente hostil que busca intimidar, perseguir e enfraquecer suas vítimas através de manifestações violentas.", array($Evidencias[1], $Evidencias[4], $Evidencias[6]), 10),
        new Entidade("Espírito", "Manifestação sobrenatural de uma presença humana falecida, capaz de interagir de forma limitada com pessoas e objetos.", array($Evidencias[0], $Evidencias[5], $Evidencias[7]), 2),
        new Entidade("Sombra", "Entidade obscura que costuma permanecer fora do campo de visão, manifestando-se através de alterações ambientais e aparições rápidas.", array($Evidencias[2], $Evidencias[4], $Evidencias[5]), 4),
        new Entidade("Wraith", "Espírito predador e territorial que se movimenta silenciosamente e costuma perseguir suas vítimas antes de atacar.", array($Evidencias[2], $Evidencias[4], $Evidencias[7]), 6),
        new Entidade("Specter", "Aparição instável que se manifesta rapidamente, deixando poucos rastros físicos e desaparecendo antes de ser observada por muito tempo.", array($Evidencias[0], $Evidencias[3], $Evidencias[8]), 1),
        new Entidade("Revenant", "Espírito vingativo extremamente agressivo, fortalecido por raiva ou desejo de vingança e conhecido por perseguir persistentemente seus alvos.", array($Evidencias[1], $Evidencias[5], $Evidencias[8]), 8)
    );

    $Locais = array(
        new Local("Casa Abandonada","Uma residência antiga marcada por aparições e objetos se movendo sozinhos.",3,["Sala","Cozinha","Quarto","Banheiro","Porão"]),
        new Local("Escola Abandonada","Uma escola fechada após diversos relatos de atividades paranormais.",5,["Recepção","Sala de Aula","Biblioteca","Banheiro","Ginásio","Diretoria"]),
        new Local("Hospital Psiquiátrico","Um antigo hospital onde pacientes desapareceram em circunstâncias misteriosas.",8,["Recepção","Enfermaria","Consultório","Necrotério","Corredor","Sala de Cirurgia"]),
        new Local("Mansão Vitoriana","Uma mansão antiga onde sombras e vozes são frequentemente relatadas.",6,["Hall","Sala de Jantar","Biblioteca","Quarto Principal","Sótão","Porão"]),
        new Local("Igreja Abandonada","Uma igreja fechada após acontecimentos sobrenaturais durante cerimônias.",4,["Nave Principal","Altar","Sacristia","Confessionário","Cripta"]),
        new Local("Asilo Saint Mary","Um antigo asilo conhecido por gritos, passos e portas se fechando sozinhas.",9,["Recepção","Dormitório","Enfermaria","Refeitório","Banheiro","Porão"]),
        new Local("Cabana da Floresta","Uma cabana isolada onde antigos moradores desapareceram sem explicação.",2,["Sala","Cozinha","Quarto","Banheiro","Depósito"])
    );

    // -------------------Fim da criação de Investigadores, Itens e Entidades-------------------

    escritaLenta("\nBEM-VINDO INVESTIGADOR!\n\n", 10);
    $Player = new Player(readline(escritaLenta("Digite seu nome: ",10)), readline(escritaLenta("\nDigite seu tipo\n1: Campo\n2: Paranormal\n3: Medium\n(Isso lhe dara mais sorte para Auto-Investigação)\n-> ", 10)));
    while (true) {
        do{
            $caso = CriarCaso($Locais, $Entidades);
            $resp = readline(escritaLenta("Novo caso gerado:\n" . $caso . "\n\nDeseja aceitar este caso? (S/N): "));
        } while ($resp);
        
    }
}

function escritaLenta(string $texto, int $velocidade = 30): null {
    for ($i = 0; $i < strlen($texto); $i++) {
        echo $texto[$i];
        usleep($velocidade * 1000);
    }
    return null;
}

function Introducao() {
    escritaLenta("Bem-vindo à Agência de Investigação Paranormal!\n");
    escritaLenta("Você é um investigador especializado em fenômenos sobrenaturais.\n");
    escritaLenta("Sua missão é investigar casos misteriosos e coletar evidências para resolver os mistérios.\n");
    Ajuda();
}

function Ajuda(){
    escritaLenta("↪ Vc terá acesso a uma equipe de investigadores especializados e uma variedade de equipamentos.\n\n");
    escritaLenta("↪ Existem 3 tipos de evidências que você poderá coletar\n");
    echo("(e cada investigador e equipamento pode apenas coletar 1 de cada tipo)\n\n");
    usleep(3000);
    escritaLenta("↪ Tipo 1: Evidências físicas (ex: rastros de mãos, rastros de sangue, baixa temperatura)\n", 20);
    escritaLenta("↪ Tipo 2: Evidências de atividade paranormal (ex: objetos voando, nível 5 de EMF, som de passos)\n", 20);
    escritaLenta("↪ Tipo 3: Evidências de manifestações espirituais (ex: aparições, voices, movimentos inexplicáveis)\n\n", 20);
    escritaLenta("↪ Equipamentos são para AUTO-COLETA de evidências\n\n");
    escritaLenta("↪ Distribua sua equipe nos cômodos da casa a cada turno para pegar evidências.\n\n");
    escritaLenta("↪ Cada caso terá um tempo limite para ser resolvido (5 turnos), e você precisará coletar evidências suficientes para identificar a entidade responsável.\n\n"); 
    readline(escritaLenta("Pressione Enter para continuar..."));
}

function CriarCaso($Locais, $Entidades) {
    $local = $Locais[array_rand($Locais)];
    $entidade = $Entidades[array_rand($Entidades)];
    $descricao = "Um caso misterioso ocorreu em " . $local->getNome() . ". Sua missão é investigar e coletar evidências para identificar a entidade responsável.";
    $orcamento = rand(1000, 5000);
    $tempoMax = 5;

    return new Caso(rand(1, 1000), $local, $descricao, $orcamento, $entidade);
}


Main();