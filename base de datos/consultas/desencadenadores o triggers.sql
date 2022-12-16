use Argosal
go

--drop trigger if exists creacion_de_metas
create trigger creacion_de_metas
	on usuarios
for insert
as
declare @dni char(8)
set @dni = (select dni from inserted)
insert into metas values(@dni,'10','10','3','1','1','4','4','1')