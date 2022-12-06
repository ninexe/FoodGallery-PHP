create database FoodGallery;

use FoodGallery;

create table tb_Tipo_Usu(
idTipo_Usu      int auto_increment,
Descricao       varchar(20),
primary key(idTipo_Usu)
);
create table tb_Usuario(
idUsuario     int auto_increment,
Email         varchar(50),
Senha         varchar(50),
Data_Cadastro datetime,
idTipo_Usu    int,
primary key(idUsuario),
constraint fk_Tipo_Usu
foreign key(idTipo_Usu)
references tb_Tipo_Usu(idTipo_Usu)
);

create table tb_Admin(
idAdmin      int auto_increment,
Nome         varchar(80),
idUsuario    int,
primary key(idAdmin),
constraint fk_Usuario0
foreign key(idUsuario)
references tb_Usuario(idUsuario) 
);

create table tb_Estabelecimento(
idEstab         int auto_increment,
CNPJ            varchar(20),
Foto			varchar(80),
Nome_Fantasia   varchar(80),
Razao_Social    varchar(80),
Nome_Gerente    varchar(80),
Email_Gerente   varchar(50),
idUsuario       int,
primary key(idEstab),
constraint fk_Usuario
foreign key(idUsuario)
references tb_Usuario(idUsuario)
);

create table tb_Cliente(
idCliente     int auto_increment,
Telefone      varchar(20),
Nome          varchar(80),
Pontuacao     int,
idUsuario     int,
primary key(idCliente),
constraint fk_Usuario1
foreign key(idUsuario)
references tb_Usuario(idUsuario) 
);

create table tb_Status(
idStatus     int auto_increment,
Status       varchar(20),
primary key(idStatus)
);

create table tb_Ticket(
idTicket      int auto_increment,
idCliente     int,
Data_Ticket   datetime,
idStatus      int,
primary key(idTicket),
constraint fk_Cliente
foreign key(idCliente)
references tb_Cliente(idCliente),
constraint fk_Status
foreign key(idStatus)
references tb_Status(idStatus)
);
create table tb_TipoProduto(
idTipoProd int auto_increment,
Descricao varchar(50),
primary key(idTipoProd)
);

create table tb_Produto(
idProduto      int auto_increment,
Descricao      varchar(80),
Preco          double,
Foto           varchar(80),
idEstab        int,
idTipoProd     int,
primary key(idProduto),
constraint fk_Estabelecimento
foreign key(idEstab)
references tb_Estabelecimento(idEstab),
constraint fk_TipoProduto
foreign key(idTipoProd)
references tb_TipoProduto(idTipoProd)
);

create table tb_Ticket_Produto(
idTicket_Produto    int auto_increment,
Qtdade_Produto 	    int,
Valor_Uni			double,
Valor_Total         double, 
idTicket 			int,
idProduto 			int,
primary key(idTicket_Produto),
constraint fk_Ticket
foreign key(idTicket)
references tb_Ticket(idTicket),
constraint fk_Produto
foreign key(idProduto)
references tb_Produto(idProduto)
);

delimiter $
create trigger tgr_Usuario after insert
on tb_Usuario
for each row
begin
if new.idTipo_Usu = 1 then 
		insert into tb_Admin(idUsuario) values(new.idUsuario);
elseif new.idTipo_Usu = 2 then 
		insert into tb_Estabelecimento(idUsuario) values(new.idUsuario);
elseif new.idTipo_Usu = 3 then
        insert into tb_Cliente(idUsuario) values(new.idUsuario);
end if;        
end $

insert into tb_tipo_usu (Descricao)
values                  ("Administrador"),
						("Gerenciador"),
						("Comum");
                        
insert into tb_usuario  (Email,Senha,idTipo_Usu,data_cadastro)
values                  ("fabio@gmail.com","1234",1,current_timestamp()),
						("guilherme@gmail.com","1234",1,current_timestamp()),
						("jorge@gmail.com","1234",1,current_timestamp()),
						("juci@gmail.com","1234",1,current_timestamp()),
						("stefany@gmail.com","1234",1,current_timestamp()),
                        ("pastelaria@gmail.com","1234",2,current_timestamp()),
                        ("pizzaria@gmail.com","1234",2,current_timestamp()),
                        ("hamburgueria@gmail.com","1234",2,current_timestamp()),
                        ("sorveteria@gmail.com","1234",2,current_timestamp());

			
insert into tb_Status  (Status)
values                 ("Aprovado"),
					   ("Pendente"),
					   ("Cancelado"),
					   ("Entregue");

insert into tb_tipoproduto (descricao)
values					   ('Pastel'),
						   ('Pizza'),
                           ('Hamburguer'),
                           ('Sorvete');

insert into tb_estabelecimento(CNPJ,Nome_Fantasia,Razao_Social,Nome_Gerente,Email_Gerente,Foto,idUsuario)
values						  ('79.852.044/0001-08','Pastelaria Sabor e Arte','Sabor e Arte LTDA','Leticia Sousa','leticia@gmail.com','pastelaria.jpeg',6),
							  ('66.199.645/0001-03','Pizzaria  Sabor da Ilha','Sabor da Ilha LTDA','Rafael Costa','rafael@hotmail.com','pizzaria.jpeg',7),
                              ('10.175.443/0001-77','Nabrasa Hamburgueria','Nabrasa LTDA','Marcos da Silva','marcos@gmail.com','hamburgueria.jpeg',8),
                              ('16.225.523/0001-76','Ice Cream','Sorveteria Ice Cream LTDA','Isabela Martins','isabela@hotmail.com','sorveteria.jpeg',9);
                         
insert into tb_produto (Descricao, Preco, Foto, idEstab,idTipoProd)
values                 ("Tres Casquinhas", 6.90, "cbS1.jpg",8,4),
					   ("Sorvete M&M", 13.90, "sorvete.jpg",8,4),
					   ("Açaí", 8.90, "acai1.jpg",8,4),
					   ("Cinco Pasteis", 8.00,"cbPs1.jpg",5,1),
					   ("Dois Pasteis", 2.50, "cbPs2.jpg",5,1),
					   ("Dois hamburgueres com fritas", 22.00, "cbH3.jpg",7,3),
					   ("Hamburguer com Onion rings", 22.00, "cbH2.jpg",7,3),
					   ("Hamburguer + refri + fritas ", 15.00, "cbH1.jpg",7,3);
                       
create view vw_cliente as
select t.Descricao as TipoUsuario,
	   u.Senha,
	   u.Email,
       c.Nome,
       c.Telefone
from tb_tipo_usu t
inner join tb_usuario u
on t.idtipo_usu = u.idtipo_usu
inner join tb_cliente c 
on u.idusuario = c.idusuario;

create view vw_estabelecimento as
select t.Descricao as TipoUsuario,
	   u.Email,
       u.Senha,
       e.CNPJ,
       e.Nome_Gerente,
       e.Nome_Fantasia,
       e.Razao_Social
from tb_tipo_usu t
inner join tb_usuario u 
on t.idtipo_usu = u.idtipo_usu
inner join tb_estabelecimento e
on u.idusuario = e.idusuario
where nome_fantasia is not null;

create view vw_admin as
select t.descricao as TipoUsuario,
	   u.Email,
       u.Senha,
       a.Nome
from tb_tipo_usu t 
inner join tb_usuario u 
on t.idtipo_usu = u.idtipo_usu
inner join tb_admin a
on u.idusuario = a.idusuario;

create view vw_usuario as
select idUsuario,
	   Email,
       Senha,
       idTipo_Usu as idTipo 
from tb_usuario;

create view vw_ClienteStatus as
select distinct c.Nome,
				u.Email,
				c.idCliente,
                t.idStatus,
                tip.idtipo_usu as idTipo,
                c.Telefone,
                c.Pontuacao,
                s. Status
from tb_tipo_usu tip 
inner join tb_usuario u  
on tip.idtipo_usu = u.idtipo_usu
left join tb_cliente c  
on c.idusuario = u.idusuario
left join tb_ticket t 
on c.idcliente = t.idcliente
left join tb_status s 
on t.idstatus = s.idstatus
where tip.idtipo_usu = 3;

create view vw_produto as
select p.idProduto,
	   e.idEstab,
       e.nome_fantasia as Estabelecimento,
	   p.Descricao,
       p.Preco,  
       p.Foto
from tb_estabelecimento e  
inner join tb_produto p 
on e.idestab = p.idestab
order by idProduto;

create view vw_emailcliente as
select cli.idcliente,
	   usu.email 
from tb_usuario usu
inner join tb_cliente cli
on usu.idusuario = cli.idusuario;

create view vw_qrcode as
select tp.qtdade_produto as Quantidade,
	   tp.valor_uni as Valor_Unitario,
       tp.Valor_Total,
       ti.Data_Ticket,
       st.Status 
from tb_ticket_produto tp
inner join tb_ticket ti
on tp.idticket = ti.idticket
inner join tb_status st
on st.idstatus = ti.idstatus;
