use Argosal
go

-- insesion de usuario --

	--drop procedure if exists sp_insertar_usuario
	create procedure sp_insertar_usuario
	@dni char(8),
	@nombre char(50),
	@clave char(40),
	@tipo char(1)
	as
	begin
		insert into usuarios(dni,nombre,clave,tipo,estado,fotoPerfil) values(@dni,@nombre,@clave,@tipo,'0','default.png')
	end 
	go

-- edición de usuario --

	-- editar usuario completo --
	--drop procedure if exists sp_editar_usuario
	create procedure sp_editar_usuario
	@dni char(8),
	@nombre char(50),
	@clave char(40),
	@fotoPerfil char(100)
	as
	begin
		update usuarios set nombre=@nombre, clave=@clave, fotoPerfil=@fotoPerfil where dni=@dni
	end 
	go

	-- editar el tipo de usuario --
	--drop procedure if exists sp_editar_usuario_administrador
	create procedure sp_editar_usuario_administrador
	@dni char(8),
	@tipo char(1)
	as
	begin
		update usuarios set tipo=@tipo where dni=@dni
	end 
	go

-- eliminar usuario --
	--drop procedure if exists sp_eliminar_usuario
	create procedure sp_eliminar_usuario
	@dni char(8)
	as
	begin
		update usuarios set activo='0' where dni=@dni
	end 
	go

-- poner en estado desactivo al usuario --
	--drop procedure if exists sp_estado_desactivo_usuario
	create procedure sp_estado_desactivo_usuario
	@dni char(8)
	as
	begin
		update usuarios set estado='0' where dni=@dni
	end 
	go

	-- poner en estado activo al usuario --
	--drop procedure if exists sp_estado_activo_usuario
	create procedure sp_estado_activo_usuario
	@dni char(8)
	as
	begin
		update usuarios set estado='1' where dni=@dni
	end 
	go

	-- poner en estado de reposo al usuario --
	--drop procedure if exists sp_estado_reposo_usuario
	create procedure sp_estado_reposo_usuario
	@dni char(8)
	as
	begin
		update usuarios set estado='2' where dni=@dni
	end 
	go

	-- poner en estado de ocupado al usuario --
	--drop procedure if exists sp_estado_ocupar_usuario
	create procedure sp_estado_ocupar_usuario
	@dni char(8)
	as
	begin
		update usuarios set estado='3' where dni=@dni
	end 
	go

	-- reactivar usuario --
	--drop procedure if exists sp_reactivar_usuario
	create procedure sp_reactivar_usuario
	@dni char(8)
	as
	begin
		declare @fecha datetime;
		set @fecha = getdate();
		update usuarios set clave='7c4a8d09ca3762af61e59520943dc26494f8941b', tipo='0', fotoPerfil='default.png', estado='0', activo='1', fechaRegistro=@fecha where dni=@dni
	end 
	go


-- insersion de ventas whatsapp --

	-- insesion de whatsapp fija --

		-- venta de fija portabilidad --
		--drop procedure if exists sp_insertar_whatsapp_fija_portabilidad
		create procedure sp_insertar_whatsapp_fija_portabilidad
		@codigo char(10),
		@dniasesor char(8),
		@nombre char(50),
		@dni char(8),
		@numeroReferencia char(11),
		@producto char(1),
		@promocion char(50),
		@tipoFija char(1),
		@telefono char(11),
		@planFija char(50),
		@modofija char(4),
		@formaDePago char(10),
		@sec char(15),
		@estado char(1),
		@observacion varchar(300),
		@ubicacion char(100),
		@distrito char(25)
		as
		begin
			insert into whatsapp(codigo,dniAsesor,nombre,dni,telefono,producto,lineaProcedente,operadorCedente,modalidad,tipo,planR,equipo,formaDePago,numeroReferencia,sec,tipoFija,planFija,modoFija,estado,observaciones,promocion,ubicacion,distrito) values(@codigo,@dniasesor,@nombre,@dni,@telefono,@producto,'---','---','-','-','---','---',@formaDePago,@numeroReferencia,@sec,@tipoFija,@planFija,@modofija,@estado,@observacion,@promocion,@ubicacion,@distrito)
		end 
		go

		-- venta de fija linea nueva --
		--drop procedure if exists sp_insertar_whatsapp_fija_lineanueva
		create procedure sp_insertar_whatsapp_fija_lineanueva
		@codigo char(10),
		@dniasesor char(8),
		@nombre char(50),
		@dni char(8),
		@numeroReferencia char(11),
		@producto char(1),
		@promocion char(50),
		@tipoFija char(1),
		@planFija char(50),
		@modofija char(4),
		@formaDePago char(10),
		@sec char(15),
		@estado char(1),
		@observacion varchar(300),
		@ubicacion char(100),
		@distrito char(25)
		as
		begin
			insert into whatsapp(codigo,dniAsesor,nombre,dni,telefono,producto,lineaProcedente,operadorCedente,modalidad,tipo,planR,equipo,formaDePago,numeroReferencia,sec,tipoFija,planFija,modoFija,estado,observaciones,promocion,ubicacion,distrito) values(@codigo,@dniasesor,@nombre,@dni,'---',@producto,'---','---','-','-','---','---',@formaDePago,@numeroReferencia,@sec,@tipoFija,@planFija,@modofija,@estado,@observacion,@promocion,@ubicacion,@distrito)
		end 
		go

	-- insercion de whatsapp movil --
		
		-- venta de movil en linea nueva --
			
			-- linea nueva en postpago --
			--drop procedure if exists sp_insertar_whatsapp_movil_lineanueva_postpago
			create procedure sp_insertar_whatsapp_movil_lineanueva_postpago
			@codigo char(10),
			@dniasesor char(8),
			@nombre char(50),
			@dni char(8),
			@numeroReferencia char(11),
			@producto char(1),
			@promocion char(50),
			@tipo char(1),
			@modalidad char(1),
			@planR char(50),
			@equipo char(50),
			@formaDePago char(10),
			@sec char(15),
			@estado char(1),
			@observacion varchar(300),
			@ubicacion char(100),
			@distrito char(25)
			as
			begin
				insert into whatsapp(codigo,dniAsesor,nombre,dni,telefono,producto,lineaProcedente,operadorCedente,modalidad,tipo,planR,equipo,formaDePago,numeroReferencia,sec,tipoFija,planFija,modoFija,estado,observaciones,promocion,ubicacion,distrito) values(@codigo,@dniasesor,@nombre,@dni,'---',@producto,'---','---',@modalidad,@tipo,@planR,@equipo,@formaDePago,@numeroReferencia,@sec,'-','---','---',@estado,@observacion,@promocion,@ubicacion,@distrito)
			end 
			go

			-- linea nueva en prepago --
			--drop procedure if exists sp_insertar_whatsapp_movil_lineanueva_prepago
			create procedure sp_insertar_whatsapp_movil_lineanueva_prepago
			@codigo char(10),
			@dniasesor char(8),
			@nombre char(50),
			@dni char(8),
			@numeroReferencia char(11),
			@producto char(1),
			@promocion char(50),
			@tipo char(1),
			@modalidad char(1),
			@equipo char(50),
			@formaDePago char(10),
			@sec char(15),
			@estado char(1),
			@observacion varchar(300),
			@ubicacion char(100),
			@distrito char(25)
			as
			begin
				insert into whatsapp(codigo,dniAsesor,nombre,dni,telefono,producto,lineaProcedente,operadorCedente,modalidad,tipo,planR,equipo,formaDePago,numeroReferencia,sec,tipoFija,planFija,modoFija,estado,observaciones,promocion,ubicacion,distrito) values(@codigo,@dniasesor,@nombre,@dni,'---',@producto,'---','---',@modalidad,@tipo,'---',@equipo,@formaDePago,@numeroReferencia,@sec,'-','---','---',@estado,@observacion,@promocion,@ubicacion,@distrito)
			end 
			go

		-- venta de movil en portabilidad --
			
			-- portabilidad en postpago --
			--drop procedure if exists sp_insertar_whatsapp_movil_portabilidad_postpago
			create procedure sp_insertar_whatsapp_movil_portabilidad_postpago
			@codigo char(10),
			@dniasesor char(8),
			@nombre char(50),
			@dni char(8),
			@numeroReferencia char(11),
			@producto char(1),
			@promocion char(50),
			@tipo char(1),
			@telefono char(11),
			@lineaProcedente char(8),
			@operadorCedente char(15),
			@modalidad char(1),
			@planR char(50),
			@equipo char(50),
			@formaDePago char(10),
			@sec char(15),
			@estado char(1),
			@observacion varchar(300),
			@ubicacion char(100),
			@distrito char(25)
			as
			begin
				insert into whatsapp(codigo,dniAsesor,nombre,dni,telefono,producto,lineaProcedente,operadorCedente,modalidad,tipo,planR,equipo,formaDePago,numeroReferencia,sec,tipoFija,planFija,modoFija,estado,observaciones,promocion,ubicacion,distrito) values(@codigo,@dniasesor,@nombre,@dni,@telefono,@producto,@lineaProcedente,@operadorCedente,@modalidad,@tipo,@planR,@equipo,@formaDePago,@numeroReferencia,@sec,'-','---','---',@estado,@observacion,@promocion,@ubicacion,@distrito)
			end 
			go

			-- portabilidad en prepago --
			--drop procedure if exists sp_insertar_whatsapp_movil_portabilidad_prepago
			create procedure sp_insertar_whatsapp_movil_portabilidad_prepago
			@codigo char(10),
			@dniasesor char(8),
			@nombre char(50),
			@dni char(8),
			@numeroReferencia char(11),
			@producto char(1),
			@promocion char(50),
			@tipo char(1),
			@telefono char(11),
			@lineaProcedente char(8),
			@operadorCedente char(15),
			@modalidad char(1),
			@equipo char(50),
			@formaDePago char(10),
			@sec char(15),
			@estado char(1),
			@observacion varchar(300),
			@ubicacion char(100),
			@distrito char(25)
			as
			begin
				insert into whatsapp(codigo,dniAsesor,nombre,dni,telefono,producto,lineaProcedente,operadorCedente,modalidad,tipo,planR,equipo,formaDePago,numeroReferencia,sec,tipoFija,planFija,modoFija,estado,observaciones,promocion,ubicacion,distrito) values(@codigo,@dniasesor,@nombre,@dni,@telefono,@producto,@lineaProcedente,@operadorCedente,@modalidad,@tipo,'---',@equipo,@formaDePago,@numeroReferencia,@sec,'-','---','---',@estado,@observacion,@promocion,@ubicacion,@distrito)
			end 
			go

		-- venta de movil en renovacion --
			
			-- renovacion en postpago --
			--drop procedure if exists sp_insertar_whatsapp_movil_renovacion_postpago
			create procedure sp_insertar_whatsapp_movil_renovacion_postpago
			@codigo char(10),
			@dniasesor char(8),
			@nombre char(50),
			@dni char(8),
			@numeroReferencia char(11),
			@producto char(1),
			@promocion char(50),
			@tipo char(1),
			@telefono char(11),
			@lineaProcedente char(8),
			@modalidad char(1),
			@planR char(50),
			@equipo char(50),
			@formaDePago char(10),
			@sec char(15),
			@estado char(1),
			@observacion varchar(300),
			@ubicacion char(100),
			@distrito char(25)
			as
			begin
				insert into whatsapp(codigo,dniAsesor,nombre,dni,telefono,producto,lineaProcedente,operadorCedente,modalidad,tipo,planR,equipo,formaDePago,numeroReferencia,sec,tipoFija,planFija,modoFija,estado,observaciones,promocion,ubicacion,distrito) values(@codigo,@dniasesor,@nombre,@dni,@telefono,@producto,@lineaProcedente,'---',@modalidad,@tipo,@planR,@equipo,@formaDePago,@numeroReferencia,@sec,'-','---','---',@estado,@observacion,@promocion,@ubicacion,@distrito)
			end 
			go

			--renovacion en prepago --
			--drop procedure if exists sp_insertar_whatsapp_movil_renovacion_prepago
			create procedure sp_insertar_whatsapp_movil_renovacion_prepago
			@codigo char(10),
			@dniasesor char(8),
			@nombre char(50),
			@dni char(8),
			@numeroReferencia char(11),
			@producto char(1),
			@promocion char(50),
			@tipo char(1),
			@telefono char(11),
			@lineaProcedente char(8),
			@modalidad char(1),
			@equipo char(50),
			@formaDePago char(10),
			@sec char(15),
			@estado char(1),
			@observacion varchar(300),
			@ubicacion char(100),
			@distrito char(25)
			as
			begin
				insert into whatsapp(codigo,dniAsesor,nombre,dni,telefono,producto,lineaProcedente,operadorCedente,modalidad,tipo,planR,equipo,formaDePago,numeroReferencia,sec,tipoFija,planFija,modoFija,estado,observaciones,promocion,ubicacion,distrito) values(@codigo,@dniasesor,@nombre,@dni,@telefono,@producto,@lineaProcedente,'---',@modalidad,@tipo,'---',@equipo,@formaDePago,@numeroReferencia,@sec,'-','---','---',@estado,@observacion,@promocion,@ubicacion,@distrito)
			end 
			go

-- insercion de archivos --
	-- insercion de productos --
		--drop procedure if exists sp_insertar_producto
		create procedure sp_insertar_producto
		@region char(10),
		@nombre char(50),
		@centro char(10),
		@almacen char(10),
		@nombreAlmacen char(50),
		@material char(20),
		@descripcion char(50),
		@libres char(5),
		@bloqueados char(5)
		as
		begin
			insert into productos(region,nombre,centro,almacen,nombreAlmacen,material,descripcion,libres,bloqueados) values(@region,@nombre,@centro,@almacen,@nombreAlmacen,@material,@descripcion,@libres,@bloqueados)
		end 
		go

	-- insercion de maviva --
		--drop procedure if exists sp_insertar_masiva
		create procedure sp_insertar_masiva
		@documento char(12),
		@nombre char(50),
		@telfijo char(10),
		@celular char(11),
		@fechaAtivacion datetime,
		@operador char(10),
		@tipoPlan char(25),
		@direccion char(50),
		@distrito char(25),
		@provincia char(25),
		@departamento char(25)
		as
		begin
			insert into masiva(documento,nombre,tel_Fijo,celular,fechaActivacion,operador,tipo_plan,direccion,distrito,provincia,departamento) values(@documento,@nombre,@telfijo,@celular,@fechaAtivacion,@operador,@tipoPlan,@direccion,@distrito,@provincia,@departamento)
		end 
		go

	-- insercion de ubicaciones --
		--drop procedure if exists sp_insertar_cac
		create procedure sp_insertar_cac
		@region char(15),
		@pdv char(10),
		@nombre char(50),
		@entrega char(20),
		@direccion char(255),
		@distrito char(30),
		@provincia char(20),
		@departamento char(20),
		@horario char(100)
		as
		begin
			insert into cac(region,pdv,nombre,entrega,direccion,distrito,provincia,departamento,horario) values(@region,@pdv,@nombre,@entrega,@direccion,@distrito,@provincia,@departamento,@horario)
		end 
		go

		--drop procedure if exists sp_insertar_dac
		create procedure sp_insertar_dac
		@nombre char(100),
		@distrito char(30),
		@provincia char(30),
		@departamento char(30),
		@region char(20),
		@direccion char(255),
		@descripcion char(100)
		as
		begin
			insert into dac(nombre,distrito,provincia,departamento,region,direccion,descripcion) values(@nombre,@distrito,@provincia,@departamento,@region,@direccion,@descripcion)
		end 
		go

		--drop procedure if exists sp_insertar_acd
		create procedure sp_insertar_acd
		@region char(20),
		@pdv char(10),
		@nombre char(100),
		@entrega char(20),
		@pdvsisact char(100),
		@codpdv char(10),
		@descripcion char(100),
		@direccion char(255),
		@distrito char(50),
		@provincia char(50),
		@departamento char(50),
		@horario char(100),
		@estado char(15),
		@alta datetime,
		@baja datetime
		as
		begin
			insert into acd(region,pdv,nombre,entrega,pdvsisact,codpdv,descripcion,direccion,distrito,provincia,departamento,horario,estado,alta,baja) values(@region,@pdv,@nombre,@entrega,@pdvsisact,@codpdv,@descripcion,@direccion,@distrito,@provincia,@departamento,@horario,@estado,@alta,@baja)
		end 
		go

		--drop procedure if exists sp_insertar_cadena
		create procedure sp_insertar_cadena
		@region char(15),
		@razonsocial char(100),
		@codigointer char(10),
		@codpdv char(10),
		@pdvsisact char(100),
		@entrega char(20),
		@direccion char(255),
		@distrito char(50),
		@provincia char(50),
		@departamento char(50),
		@dias char(50),
		@horario char(100),
		@estado char(15)
		as
		begin
			insert into cadena(region,razonsocial,codigointer,codpdv,pdvsisact,entrega,direccion,distrito,provincia,departamento,dias,horario,estado) values(@region,@razonsocial,@codigointer,@codpdv,@pdvsisact,@entrega,@direccion,@distrito,@provincia,@departamento,@dias,@horario,@estado)
		end 
		go

-- edicion de ventas whatsapp --

	-- edicion de whatsapp fija --

		-- venta de fija portabilidad --
		--drop procedure if exists sp_editar_whatsapp_fija_portabilidad
		create procedure sp_editar_whatsapp_fija_portabilidad
		@codigo char(10),
		@dniasesor char(8),
		@nombre char(50),
		@dni char(8),
		@numeroReferencia char(11),
		@producto char(1),
		@promocion char(50),
		@tipoFija char(1),
		@telefono char(11),
		@planFija char(50),
		@modofija char(4),
		@formaDePago char(10),
		@sec char(15),
		@estado char(1),
		@observacion varchar(300),
		@ubicacion char(100),
		@distrito char(25)
		as
		begin
			declare @fechaUpdate datetime;
			set @fechaUpdate = getdate();
			update whatsapp set dniAsesor=@dniasesor, nombre=@nombre, dni=@dni, numeroReferencia=@numeroReferencia, producto=@producto, promocion=@promocion, tipoFija=@tipoFija, telefono=@telefono, planFija=@planFija, modoFija=@modofija, formaDePago=@formaDePago, sec=@sec, estado=@estado, observaciones=@observacion, ubicacion=@ubicacion, distrito=@distrito, fechaActualizacion=@fechaUpdate where codigo=@codigo
		end 
		go

		-- venta de fija linea nueva --
		--drop procedure if exists sp_editar_whatsapp_fija_lineanueva
		create procedure sp_editar_whatsapp_fija_lineanueva
		@codigo char(10),
		@dniasesor char(8),
		@nombre char(50),
		@dni char(8),
		@numeroReferencia char(11),
		@producto char(1),
		@promocion char(50),
		@tipoFija char(1),
		@planFija char(50),
		@modofija char(4),
		@formaDePago char(10),
		@sec char(15),
		@estado char(1),
		@observacion varchar(300),
		@ubicacion char(100),
		@distrito char(25)
		as
		begin
			declare @fechaUpdate datetime;
			set @fechaUpdate = getdate();
			update whatsapp set dniAsesor=@dniasesor, nombre=@nombre, dni=@dni, numeroReferencia=@numeroReferencia, producto=@producto, promocion=@promocion, tipoFija=@tipoFija, planFija=@planFija, modoFija=@modofija, formaDePago=@formaDePago, sec=@sec, estado=@estado, observaciones=@observacion, ubicacion=@ubicacion, distrito=@distrito, fechaActualizacion=@fechaUpdate where codigo=@codigo
		end 
		go

	-- edicion de whatsapp movil --
		
		-- venta de movil en linea nueva --
			
			-- linea nueva en postpago --
			--drop procedure if exists sp_editar_whatsapp_movil_lineanueva_postpago
			create procedure sp_editar_whatsapp_movil_lineanueva_postpago
			@codigo char(10),
			@dniasesor char(8),
			@nombre char(50),
			@dni char(8),
			@numeroReferencia char(11),
			@producto char(1),
			@promocion char(50),
			@tipo char(1),
			@modalidad char(1),
			@planR char(50),
			@equipo char(50),
			@formaDePago char(10),
			@sec char(15),
			@estado char(1),
			@observacion varchar(300),
			@ubicacion char(100),
			@distrito char(25)
			as
			begin
				declare @fechaUpdate datetime;
				set @fechaUpdate = getdate();
				update whatsapp set dniAsesor=@dniasesor, nombre=@nombre, dni=@dni, numeroReferencia=@numeroReferencia, producto=@producto, promocion=@promocion, tipo=@tipo, modalidad=@modalidad, planR=@planR, equipo=@equipo, formaDePago=@formaDePago, sec=@sec, estado=@estado, observaciones=@observacion, ubicacion=@ubicacion, distrito=@distrito, fechaActualizacion=@fechaUpdate where codigo=@codigo
			end 
			go

			-- linea nueva en prepago --
			--drop procedure if exists sp_editar_whatsapp_movil_lineanueva_prepago
			create procedure sp_editar_whatsapp_movil_lineanueva_prepago
			@codigo char(10),
			@dniasesor char(8),
			@nombre char(50),
			@dni char(8),
			@numeroReferencia char(11),
			@producto char(1),
			@promocion char(50),
			@tipo char(1),
			@modalidad char(1),
			@equipo char(50),
			@formaDePago char(10),
			@sec char(15),
			@estado char(1),
			@observacion varchar(300),
			@ubicacion char(100),
			@distrito char(25)
			as
			begin
				declare @fechaUpdate datetime;
				set @fechaUpdate = getdate();
				update whatsapp set dniAsesor=@dniasesor, nombre=@nombre, dni=@dni, numeroReferencia=@numeroReferencia, producto=@producto, promocion=@promocion, tipo=@tipo, modalidad=@modalidad, equipo=@equipo, formaDePago=@formaDePago, sec=@sec, estado=@estado, observaciones=@observacion, ubicacion=@ubicacion, distrito=@distrito, fechaActualizacion=@fechaUpdate where codigo=@codigo
			end 
			go

		-- venta de movil en portabilidad --
			
			-- portabilidad en postpago --
			--drop procedure if exists sp_editar_whatsapp_movil_portabilidad_postpago
			create procedure sp_editar_whatsapp_movil_portabilidad_postpago
			@codigo char(10),
			@dniasesor char(8),
			@nombre char(50),
			@dni char(8),
			@numeroReferencia char(11),
			@producto char(1),
			@promocion char(50),
			@tipo char(1),
			@telefono char(11),
			@lineaProcedente char(8),
			@operadorCedente char(15),
			@modalidad char(1),
			@planR char(50),
			@equipo char(50),
			@formaDePago char(10),
			@sec char(15),
			@estado char(1),
			@observacion varchar(300),
			@ubicacion char(100),
			@distrito char(25)
			as
			begin
				declare @fechaUpdate datetime;
				set @fechaUpdate = getdate();
				update whatsapp set dniAsesor=@dniasesor, nombre=@nombre, dni=@dni, numeroReferencia=@numeroReferencia, producto=@producto, promocion=@promocion, tipo=@tipo, telefono=@telefono, lineaProcedente=@lineaProcedente, operadorCedente=@operadorCedente, modalidad=@modalidad, planR=@planR, equipo=@equipo, formaDePago=@formaDePago, sec=@sec, estado=@estado, observaciones=@observacion, ubicacion=@ubicacion, distrito=@distrito, fechaActualizacion=@fechaUpdate where codigo=@codigo
			end 
			go

			-- portabilidad en prepago --
			--drop procedure if exists sp_editar_whatsapp_movil_portabilidad_prepago
			create procedure sp_editar_whatsapp_movil_portabilidad_prepago
			@codigo char(10),
			@dniasesor char(8),
			@nombre char(50),
			@dni char(8),
			@numeroReferencia char(11),
			@producto char(1),
			@promocion char(50),
			@tipo char(1),
			@telefono char(11),
			@lineaProcedente char(8),
			@operadorCedente char(15),
			@modalidad char(1),
			@equipo char(50),
			@formaDePago char(10),
			@sec char(15),
			@estado char(1),
			@observacion varchar(300),
			@ubicacion char(100),
			@distrito char(25)
			as
			begin
				declare @fechaUpdate datetime;
				set @fechaUpdate = getdate();
				update whatsapp set dniAsesor=@dniasesor, nombre=@nombre, dni=@dni, numeroReferencia=@numeroReferencia, producto=@producto, promocion=@promocion, tipo=@tipo, telefono=@telefono, lineaProcedente=@lineaProcedente, operadorCedente=@operadorCedente, modalidad=@modalidad, equipo=@equipo, formaDePago=@formaDePago, sec=@sec, estado=@estado, observaciones=@observacion, ubicacion=@ubicacion, distrito=@distrito, fechaActualizacion=@fechaUpdate where codigo=@codigo
			end 
			go

		-- venta de movil en renovacion --
			
			-- renovacion en postpago --
			--drop procedure if exists sp_editar_whatsapp_movil_renovacion_postpago
			create procedure sp_editar_whatsapp_movil_renovacion_postpago
			@codigo char(10),
			@dniasesor char(8),
			@nombre char(50),
			@dni char(8),
			@numeroReferencia char(11),
			@producto char(1),
			@promocion char(50),
			@tipo char(1),
			@telefono char(11),
			@lineaProcedente char(8),
			@modalidad char(1),
			@planR char(50),
			@equipo char(50),
			@formaDePago char(10),
			@sec char(15),
			@estado char(1),
			@observacion varchar(300),
			@ubicacion char(100),
			@distrito char(25)
			as
			begin
				declare @fechaUpdate datetime;
				set @fechaUpdate = getdate();
				update whatsapp set dniAsesor=@dniasesor, nombre=@nombre, dni=@dni, numeroReferencia=@numeroReferencia, producto=@producto, promocion=@promocion, tipo=@tipo, telefono=@telefono, lineaProcedente=@lineaProcedente, modalidad=@modalidad, planR=@planR, equipo=@equipo, formaDePago=@formaDePago, sec=@sec, estado=@estado, observaciones=@observacion, ubicacion=@ubicacion, distrito=@distrito, fechaActualizacion=@fechaUpdate where codigo=@codigo
			end 
			go

			-- renovacion en prepago --
			--drop procedure if exists sp_editar_whatsapp_movil_renovacion_prepago
			create procedure sp_editar_whatsapp_movil_renovacion_prepago
			@codigo char(10),
			@dniasesor char(8),
			@nombre char(50),
			@dni char(8),
			@numeroReferencia char(11),
			@producto char(1),
			@promocion char(50),
			@tipo char(1),
			@telefono char(11),
			@lineaProcedente char(8),
			@modalidad char(1),
			@equipo char(50),
			@formaDePago char(10),
			@sec char(15),
			@estado char(1),
			@observacion varchar(300),
			@ubicacion char(100),
			@distrito char(25)
			as
			begin
				declare @fechaUpdate datetime;
				set @fechaUpdate = getdate();
				update whatsapp set dniAsesor=@dniasesor, nombre=@nombre, dni=@dni, numeroReferencia=@numeroReferencia, producto=@producto, promocion=@promocion, tipo=@tipo, telefono=@telefono, lineaProcedente=@lineaProcedente, modalidad=@modalidad, equipo=@equipo, formaDePago=@formaDePago, sec=@sec, estado=@estado, observaciones=@observacion, ubicacion=@ubicacion, distrito=@distrito, fechaActualizacion=@fechaUpdate where codigo=@codigo
			end 
			go


-- edicion de metas

--drop procedure if exists sp_editar_metas
create procedure sp_editar_metas
@portamen69 char(3),
@portamay69 char(3),
@altapost char(3),
@altaprepa char(3),
@portaprepa char(3),
@renovacion char(3),
@hfc_ftth char(3),
@ifi char(3)
as
begin
	update metas set portamenor69=@portamen69,portamayor69=@portamay69,altapost=@altapost,altaprepa=@altaprepa,portaprepa=@portaprepa,renovacion=@renovacion,hfc_ftth=@hfc_ftth,ifi=@ifi where dniAsesor='general'
end 
go

--drop procedure if exists sp_editar_metas_asesor
create procedure sp_editar_metas_asesor
@dni char(8),
@portamen69 char(3),
@portamay69 char(3),
@altapost char(3),
@altaprepa char(3),
@portaprepa char(3),
@renovacion char(3),
@hfc_ftth char(3),
@ifi char(3)
as
begin
	update metas set portamenor69=@portamen69,portamayor69=@portamay69,altapost=@altapost,altaprepa=@altaprepa,portaprepa=@portaprepa,renovacion=@renovacion,hfc_ftth=@hfc_ftth,ifi=@ifi where dniAsesor=@dni
end 
go
