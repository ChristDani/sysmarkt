
use Argosal
go

-- generacion de codigo --

-- codigo de whatsapp --

create function dbo.Gencodwhats() returns char(10)
as begin
	declare @Codigo char(10)
	declare @Cant int
		set @Cant =(select count (*) from whatsapp)
		if @Cant=0
			set @Codigo='WP00000001'
		else 
			begin
				set @Codigo=(select Max(Substring(codigo,3,8))from whatsapp)
				set @Codigo='WP'+Right('00000000'+Cast (Cast (@Codigo as int )+1 as varchar(8)),8)
			end 
	return @Codigo
end 
go