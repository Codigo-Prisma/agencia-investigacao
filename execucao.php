<?php
require_once('modelo/Player.php');
require_once('modelo/InvCampo.php');
require_once('modelo/InvMedium.php');
require_once('modelo/InvParanormal.php');
require_once('modelo/Itens.php');
require_once('modelo/Entidade.php');
require_once('modelo/Local.php');
require_once('modelo/Caso.php');
require_once('modelo/Contrato.php');


function Main()
{
    escritaLenta("Vc Gostaria de iniciar do começo? (S/N): ");
    $resp = readline();
    if (strtoupper($resp) === "S") {
        escritaLenta("Iniciando do começo...\n");
        Introducao();
        Jogo();
    } else {
        escritaLenta("\n\nContinuando de onde parou...\n");
        if (strtoupper(readline("Skip? s/n")) === "S") {
            Jogo(true);
        } else {
            Jogo();
        }
    }
}

function Jogo($Skip = false)
{
    // ----------------- Criação de Investigadores, Itens e Entidades -------------------

    $Contratos = array(
        new Contrato(100.0, new InvCampo("Agente 1")),
        new Contrato(150.0, new InvMedium("Agente 2")),
        new Contrato(200.0, new InvParanormal("Agente 3"))
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

    $EvidenciasAchadas = [];

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
        new Local("Casa Abandonada", "Uma residência antiga marcada por aparições e objetos se movendo sozinhos.", 3, ["Sala", "Cozinha", "Quarto", "Banheiro", "Porão"]),
        new Local("Escola Abandonada", "Uma escola fechada após diversos relatos de atividades paranormais.", 5, ["Recepção", "Sala de Aula", "Biblioteca", "Banheiro", "Ginásio", "Diretoria"]),
        new Local("Hospital Psiquiátrico", "Um antigo hospital onde pacientes desapareceram em circunstâncias misteriosas.", 8, ["Recepção", "Enfermaria", "Consultório", "Necrotério", "Corredor", "Sala de Cirurgia"]),
        new Local("Mansão Vitoriana", "Uma mansão antiga onde sombras e vozes são frequentemente relatadas.", 6, ["Hall", "Sala de Jantar", "Biblioteca", "Quarto Principal", "Sótão", "Porão"]),
        new Local("Igreja Abandonada", "Uma igreja fechada após acontecimentos sobrenaturais durante cerimônias.", 4, ["Nave Principal", "Altar", "Sacristia", "Confessionário", "Cripta"]),
        new Local("Asilo Saint Mary", "Um antigo asilo conhecido por gritos, passos e portas se fechando sozinhas.", 9, ["Recepção", "Dormitório", "Enfermaria", "Refeitório", "Banheiro", "Porão"]),
        new Local("Cabana da Floresta", "Uma cabana isolada onde antigos moradores desapareceram sem explicação.", 2, ["Sala", "Cozinha", "Quarto", "Banheiro", "Depósito"])
    );

    // -------------------Fim da criação de Investigadores, Itens e Entidades-------------------
    if (!$Skip) {
        escritaLenta("Abrindo o sistema de investigação...\n", 50);
        escritaLenta("\nBEM-VINDO INVESTIGADOR!\n\n", 10);
        $Player = new Player(readline(escritaLenta("Digite seu nome: ", 10)), FazerPlayer());
    } else {
        $Player = new Player("Mitsuki", new InvMedium("Player"));
    }

    while (true) {
        $caso = 0;
        $resp = "";
        if (!$Skip) {
            do {
                $caso = CriarCaso($Locais, $Entidades);
                $resp = readline(escritaLenta("\n\nAbrindo um Caso ñ resolvido:\n\n" . $caso . "\n\nDeseja aceitar este caso? (S/N): "));
            } while (!(strtoupper($resp) == "S"));
        } else {
            $caso = CriarCaso($Locais, $Entidades);
        }


        escritaLenta("\n\nCaso aceito! Iniciando seleção de investigadores e itens...\n", 10);
        $ConSelecionados = escolhaCompra($Contratos, $caso);
        $ItensSelecionados = escolhaCompra($Itens, $caso);
        $turno = 1;
        while ($turno <= 5) {
            escritaLenta("\n\nTurno " . $turno . " de 5\n", 10);
            switch (Menu()) {
                case 1: 
                    DistribuirTurno($ConSelecionados, $ItensSelecionados, $caso, $Player);
                    break;
                case 2:
                    escritaLenta("\nListando Evidências Coletadas...\n", 10);
                    foreach ($EvidenciasAchadas as $i => $Evidencia) {
                        echo ($i + 1) . " - " . $Evidencia[0] . "\n";
                    }
                    break;
                case 3:
                    switch (TentarAdivinhar($caso, $Entidades, $EvidenciasAchadas)) {
                        case -1:
                            Perdeu($caso);
                            break 2;
                        case 1:
                            Ganhou($caso);
                            break 2;
                        default:
                            break;
                    }
                    break;
                case 4:
                    Guia($Entidades, $Evidencias, $EvidenciasAchadas);
                    break;
                case 5:
                    ProximoTurno($ConSelecionados, $EvidenciasAchadas, $ItensSelecionados, $caso, $Player, $turno);
                    break;
                default:
                    escritaLenta("\nOpção inválida. Tente novamente.\n", 10);
            }
        }
    }
}

function Perdeu($caso)
{
    escritaLenta("...\n", 1);
    escritaLenta("O resultado era...\n\n");
    echo $caso->getEntidade();
    escritaLenta("\n\nVc errou seu palpite...\n");
    escritaLenta("Adivinhe melhor na próxima");
    escritaLenta("Indo para o proximo caso...", 10);
}
function Ganhou($caso)
{
    escritaLenta("...\n", 1);
    escritaLenta("O resultado era...\n\n");
    echo $caso->getEntidade();
    escritaLenta("\n\nMeus parabéns por acertar corretamente\n");
    escritaLenta("Indo para o proximo caso...", 10);
}
function TentarAdivinhar($caso, $Entidades, $EvidenciasAchadas)
{
    $EntidadesFiltradas = FiltrarEntidades($EvidenciasAchadas, $Entidades);

    do {
        $resp = readline("\n\nQual o seu palpite? 0 - cancelar");
    } while ($resp >= 0 && $resp <= count($EntidadesFiltradas));

    if ($resp == 0) {
        return 0;
    }

    $resp--;

    if ($EntidadesFiltradas[$resp]->getNome() == $caso->getEntidade()->getNome()) {
        return 1;
    } else {
        return -1;
    }
}

function FiltrarEntidades($EvidenciasAchadas, $Entidades)
{
    escritaLenta("Suas evidencias...\n", 20);
    foreach ($EvidenciasAchadas as $i => $Evidencia) {
        echo " || " . $Evidencia[0];
    }
    escritaLenta("\n\nPossiveis Entidades (Filtradas)...\n\n", 20);

    $total_necessario = count($EvidenciasAchadas);

    $objetos_filtrados = [];

    foreach ($Entidades as $objeto) {
        $array_do_objeto = $objeto->getEviPossiveis();

        // Verifica a interseção entre o array das Evidencias Achadas e o array das Entidades
        $interseccao = array_intersect($EvidenciasAchadas, $array_do_objeto);

        if (count($interseccao) === $total_necessario) {
            $objetos_filtrados[] = $objeto;
        }
    }

    foreach ($objetos_filtrados as $i => $valor) {
        echo ($i + 1) . " - " . $valor . "\n";
    }
    return $objetos_filtrados;
}

function ProximoTurno(array $ConSelecionados, array $EvidenciasAchadas, array $ItensSelecionados, Caso $caso, Player $Player, int &$turno)
{
    escritaLenta("\nIniciando próximo turno...\n", 10);
    foreach ($ConSelecionados as $Contrato) {
        $resultado = $Contrato->getInvestigador()->coletarEvidencias($caso);
        if ($resultado !== null) {
            $EvidenciasAchadas[] = $resultado;
        }
        $Contrato->getInvestigador()->resetarComodoDesignado();
    }
    // foreach ($ItensSelecionados as $Item) {
    //     $Item->coletarEvidencias($caso);
    // }
    // Preguica de implementar os itens agr
    if ($Player->getTipo() !== null) {
        $Player->getTipo()->coletarEvidencias($caso);
        $Player->getTipo()->resetarComodoDesignado();
    }
    $turno++;
}
function DistribuirTurno(array $ConSelecionados, array $ItensSelecionados, Caso $caso, Player $Player)
{
    escritaLenta("\nDistribuindo Turno...\n", 10);
    while (true) {

        echo "1 - Vc mesmo (Auto-Investigação)\n";
        foreach ($ConSelecionados as $i => $Contrato) {
            echo "\n" . ($i + 2) . " - " . $Contrato->getInvestigador()->getNome() . "...\n";
        }

        $opcao = readlineComIntervalo("Escolha alguém para distribuir: ", 1, count($ConSelecionados) + 1);

        // Operador ternario ("?") é apenas um if e else em uma linha, para simplificar o código. 
        echo ($opcao == 1 ? "Você escolheu Auto-Investigação." : "Você escolheu " . $ConSelecionados[$opcao - 2]->getNome() . ".") . "\n";
        $comodoEscolhido = readlineComIntervalo("Escolha um cômodo para você investigar:\n" . $caso->getLocal()->__toString() . "\nDigite o número do cômodo escolhido: ", 1, count($caso->getLocal()->getComodos()));
        $indiceComodo = $comodoEscolhido - 1;

        if ($opcao == 1) {
            $Player->getTipo()->setComodoDesignado($indiceComodo);
            escritaLenta("\nVocê foi designado para investigar o cômodo " . $caso->getLocal()->getComodos()[$indiceComodo] . ".\n", 10);
            break;
        } else {
            $indice = $opcao - 2;
            $ContratoEscolhido = $ConSelecionados[$indice];
            $ContratoEscolhido->getInvestigador()->setComodoDesignado($indiceComodo);
            escritaLenta("\n" . $ContratoEscolhido->getNome() . " foi designado para investigar o cômodo " . $caso->getLocal()->getComodos()[$indiceComodo] . ".\n", 10);
            break;
        }
    }
}
function Guia($Entidades, $Evidencias, $EvidenciasAchadas)
{
    escritaLenta("\nAbrindo Guia...\n", 10);
    echo "1 - Listar Evidencias Possíveis\n";
    echo "2 - Listar Entidades Possíveis\n";
    echo "3 - AJUDA NAO SEI DE NADA\n";
    $opcao = readlineComIntervalo("Escolha uma opção: ", 1, 3);
    switch ($opcao) {
        case 1:
            escritaLenta("\nListando Evidências Possíveis...\n", 10);
            foreach ($Evidencias as $i => $Evidencia) {
                echo ($i + 1) . " - " . $Evidencia[0] . "\n";
            }

            break;
        case 2:
            escritaLenta("\nListando Entidades Possíveis...\n", 10);
            foreach ($Entidades as $entidade) {
                echo $entidade->__toString();
            }
            break;
        case 3:
            escritaLenta("\nExibindo ajuda...\n", 10);
            Ajuda();
            break;
    }
    readline(escritaLenta("\nPressione Enter para continuar...", 10));
}
function FazerPlayer()
{
    $resp = readline(escritaLenta("\nDigite seu tipo\n1: Campo\n2: Paranormal\n3: Medium\n(Isso lhe dara mais sorte para Auto-Investigação)\n-> ", 10));
    switch ($resp) {
        case 1:
            return new InvCampo("Player");
        case 2:
            return new InvParanormal("Player");
        case 3:
            return new InvMedium("Player");
        default:
            escritaLenta("\nOpção inválida. Por favor, escolha novamente.\n", 10);
            return FazerPlayer();
    }
}
function readlineComIntervalo($prompt, $min, $max)
{
    while (true) {
        $input = (int)readline($prompt);
        if ($input >= $min && $input <= $max) {
            return $input;
        } else {
            echo "insira um número entre $min e $max.\n";
        }
    }
}

function Menu()
{
    echo "\n\nMENU PRINCIPAL\n";
    echo "1 - Distribuir Turno\n";
    echo "2 - Verificar Evidências Coletadas\n";
    echo "3 - Tentar Identificar Entidade\n";
    echo "4 - Guias\n\n";
    echo "5 - Proximo Turno\n\n";

    return readlineComIntervalo("Escolha uma opção: ", 1, 5);
}

function escolhaCompra($var, $caso)
{
    $orcamento = $caso->getorcamento();
    if (!is_array($var) || empty($var)) {
        return array([], $orcamento);
    }

    $selecionados = array();
    $custoTotal = 0;

    echo "FAÇA SUAS ESCOLHAS:\n\n";

    while (true) {
        $orcamentoRestante = $orcamento - $custoTotal;
        echo "\nOrçamento disponível: R$ " . number_format($orcamentoRestante, 2, ',', '.') . "\n";
        echo "Escolha um item (ou digite 'fim' para encerrar a seleção):\n";

        foreach ($var as $index => $Valor) {
            echo ($index + 1) . ". " . $Valor->getNome() . " - Custo: R$ " . number_format($Valor->getCusto(), 2, ',', '.') . "\n";
        }

        $escolha = readline("Digite o número do item escolhido: ");
        if (strtolower($escolha) === 'fim') {
            break;
        }

        $indice = (int) $escolha - 1;
        $existe = false;
        foreach ($selecionados as $item) {
            if ($item->getNome() === $var[$indice]->getNome()) {
                $existe = true;
                break;
            }
        }
        if (isset($var[$indice]) && $indice >= 0 && $indice < count($var) && !$existe) {
            $ValorEscolhido = $var[$indice];

            if ($custoTotal + $ValorEscolhido->getCusto() <= $orcamento) {
                $selecionados[] = $ValorEscolhido;
                $custoTotal += $ValorEscolhido->getCusto();
                echo "Item " . $ValorEscolhido->getNome() . " adicionado(a) à seleção.\n";
            } else {
                echo "Orçamento insuficiente para adicionar este item.\n";
            }
        } else {
            echo "\nOpção inválida. Tente novamente.\n\n";
        }
    }
    $caso->setorcamento($orcamento - $custoTotal);
    return $selecionados;
}

function escritaLenta(string $texto, int $velocidade = 30): null
{
    for ($i = 0; $i < strlen($texto); $i++) {
        echo $texto[$i];
        usleep($velocidade * 1000);
    }
    return null;
}

function Introducao()
{
    escritaLenta("Bem-vindo à Agência de Investigação Paranormal!\n");
    escritaLenta("Você é um investigador especializado em fenômenos sobrenaturais.\n");
    escritaLenta("Sua missão é investigar casos misteriosos e coletar evidências para resolver os mistérios.\n");
    Ajuda();
    readline(escritaLenta("Pressione Enter para continuar..."));
}

function Ajuda()
{
    escritaLenta("↪ Vc terá acesso a uma equipe de investigadores especializados e uma variedade de equipamentos.\n\n");
    escritaLenta("↪ Existem 3 tipos de evidências que você poderá coletar\n");
    echo ("(e cada investigador e equipamento pode apenas coletar 1 de cada tipo)\n\n");
    usleep(3000);
    escritaLenta("↪ Tipo 1: Evidências físicas (ex: rastros de mãos, rastros de sangue, baixa temperatura)\n", 20);
    escritaLenta("↪ Tipo 2: Evidências de atividade paranormal (ex: objetos voando, nível 5 de EMF, som de passos)\n", 20);
    escritaLenta("↪ Tipo 3: Evidências de manifestações espirituais (ex: aparições, voices, movimentos inexplicáveis)\n\n", 20);
    escritaLenta("↪ Equipamentos são para AUTO-COLETA de evidências\n\n");
    escritaLenta("↪ Distribua sua equipe nos cômodos da casa a cada turno para pegar evidências.\n\n");
    escritaLenta("↪ Cada caso terá um tempo limite para ser resolvido (5 turnos), e você precisará coletar evidências suficientes para identificar a entidade responsável.\n\n");
}

function CriarCaso($Locais, $Entidades)
{
    $local = $Locais[array_rand($Locais)];
    $entidade = $Entidades[array_rand($Entidades)];
    $descricao = "Um caso misterioso ocorreu em " . $local->getNome() . ". Sua missão é identificar a entidade responsável.";
    $orcamento = rand(1000, 5000);
    $tempoMax = 5;

    return new Caso(rand(1, 1000), $local, $descricao, $orcamento, $entidade);
}



Main();