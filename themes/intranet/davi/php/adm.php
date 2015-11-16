<?php
include ("../html/_aux/head.html");
?>

	<div class="demo-info" style="margin-bottom:10px">
	
		<div><div class="demo-tip icon-tip">&nbsp;</div>Clique na opção desejada na barra de ferramentas.</div>
		<br>
	
	<table id="dg" title="Cadastro de Exames" class="easyui-datagrid" style="width:1040px;height:380px "
			url="../biblioteca/pegar_cadastroclientes.php"
			toolbar="#toolbar" pagination="true"
			rownumbers="true" fitColumns="true" singleSelect="true">
		<thead>
			<tr>
				<th align="center" field="nome" width="30">Solicitante</th>
				<th align="center" field="data" width="20">Aberto em</th>
				<th align="center" field="setor" width="30">Setor</th>
				<th align="center" field="exame" width="20">Exame</th>
				<th align="center" field="status" width="20">Status</th>
				<th align="center" field="ospt" width="20">O.S Paciente Teste</th>
				<th align="center" field="assinado" width="20">Assinado por</th>
				<th align="center" field="dataf" width="20">Fechado em</th>
			</tr>
		</thead>
	</table>
	<div id="toolbar">
		<a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()" title="Alterar Dados do Cliente">Editar Solicitação</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="removeUser()" title="Remover Dados do Cliente">Remover Solicitação</a>
		<a href="user.php"  target="_blank" class="easyui-linkbutton" iconCls="icon-user" plain="true" onclick="#" title="Página do Usuário">Página do Usuário</a>
	</div>
	
<?php
include ("../html/_menus/modificar.html"); 
?>
