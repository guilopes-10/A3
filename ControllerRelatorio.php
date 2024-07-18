<?php 

 include_once 'Conexao.php';


 $database = new Conexao();
 $conn = $database->fazConexao();

if($_SERVER['REQUEST_METHOD'] == "POST"){

    $tipoatendimento = $_POST['tipoatendimento'];
    $tipopessoal = $_POST['tipopessoal'];
    $tipomotivo = $_POST['motivo'];
    $dataincial = $_POST['data-inicial'];
    $datafinal = $_POST['data-final'];

    if(!empty($tipoatendimento)) {
        $andCadastro = "and cadastro.tipoCadastro = $tipoatendimento";
    }else {
        $andCadastro = "";
    }

    if(!empty($tipopessoal)) {
        $andPerfil ="and cadastro.perfilCadastro = $tipopessoal";
    } else {
        $andPerfil = "";
    }

    if(!empty($tipomotivo)) {
        $andPergunta = "and cadastro.idPerguntaPublico = $tipomotivo";
    } else {
        $andPergunta = "";
    }

    if (!empty($dataincial) && !empty($datafinal)) {
        $datafinal_adjusted = date('Y-m-d', strtotime($datafinal . ' +1 day'));
        $andData = "and cadastro.dataCadastro >= '$dataincial' AND cadastro.dataCadastro < '$datafinal_adjusted'";
    } else {
        $andData = "";
    }

    $sql = "SELECT 
                cadastro.*,
                usuario.loginUsuario,
                perguntapublico.descricaoPergunta
            FROM 
                cadastro
            inner join usuario on
                cadastro.idUsuario = usuario.idUsuario
            inner join perguntapublico on
                cadastro.idPerguntaPublico = perguntapublico.idPerguntaPublico
            where cadastro.idUsuario > 0
            $andCadastro
            $andPerfil
            $andPergunta
            $andData
            ";

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        session_start();
        $_SESSION['result'] = $result;
    
        header("Location: relatorio.php");
        exit();
}
?>
