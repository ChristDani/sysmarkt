use Argosal
go

-- pruebas usuarios --

	-- insersion de usuarios --
	exec sp_insertar_usuario '12457889','user prueba','7110eda4d09e062aa5e4a390b0a572ac0d2c0220','0','none'
	select * from usuarios

	-- editar usuario --
	exec sp_editar_usuario '12457889','prueba editar','7110eda4d09e062aa5e4a390b0a572ac0d2c0220','con foto','perfil'
	select * from usuarios

	-- cambiar tipo de usuario --
	exec sp_editar_usuario_administrador '12457889','1'
	select * from usuarios

	-- estados de usuario -- 
		-- activo --
		exec sp_estado_activo_usuario '12457889'
		select * from usuarios
		-- desactivo --
		exec sp_estado_desactivo_usuario '12457889'
		select * from usuarios
		-- reposo --
		exec sp_estado_reposo_usuario '12457889'
		select * from usuarios

	-- eliminar usuario --
	exec sp_eliminar_usuario '73179453'
	select * from usuarios

-- pruebas insercion clientes --
	-- insercion de ventas fija --
		-- fija linea nueva --
		declare @codigo char(10);
		set @codigo = dbo.Gencodwhats();
		exec sp_insertar_whatsapp_fija_lineanueva @codigo,'73179455','usuario prueba fija ln','12345678','123456789','0','---','0','1 Play','HFC','Contado','45788956','2','venta de linea nueva en fija','por su casa al lado','un distrito'
		select * from whatsapp
		-- fija portabilidad --
		declare @codigo char(10);
		set @codigo = dbo.Gencodwhats();
		exec sp_insertar_whatsapp_fija_portabilidad @codigo,'73179455','usuario pueba fija port','87654321','123456789','0','50% dsct en fija','1','654578','2 Play','IFI','Contado','78895645','0','No requirió el servicio','sin señal','no distric'
		select * from whatsapp
	-- insercion de ventas movil --
		-- movil linea nueva postpago --
		declare @codigo char(10);
		set @codigo = dbo.Gencodwhats();
		exec sp_insertar_whatsapp_movil_lineanueva_postpago @codigo,'73179455','prueba movil lnP','56897845','987451256','1','---','0','1','79','a53','Cuotas','98452648','1','compro sin problemas','en su casa','un distrito'
		select * from whatsapp
		-- movil linea nueva prepago --
		declare @codigo char(10);
		set @codigo = dbo.Gencodwhats();
		exec sp_insertar_whatsapp_movil_lineanueva_prepago @codigo,'73179455','prueba cliente ln Prepa','12345678','987654321','1','Lineas Adicionales','0','0','Chip','Contado','48575968','2','verificacion de la sec','chiclayo','chiclayo'
		select * from whatsapp
		-- movil portabilidad postpago --
		declare @codigo char(10);
		set @codigo = dbo.Gencodwhats();
		exec sp_insertar_whatsapp_movil_portabilidad_postpago @codigo,'73179455','user prueba porta post','12345678','123456789','1','20% portabilidad','1','985645128','0','Bitel','Postpago','29','huawei','Cuotas','45789856','2','observacion','ubicacion','su distriito'
		select * from whatsapp
		-- movil portabilidad prepago --
		declare @codigo char(10);
		set @codigo = dbo.Gencodwhats();
		exec sp_insertar_whatsapp_movil_portabilidad_prepago @codigo,'73179455','user prueba porta en pre','45789856','895678451','1','---','1','956784523','Prepago','Movistar','0','Chip','Contado','45788956','1','sin observacion','con ubicaicon','distrito'
		select * from whatsapp
		-- movil renovacion postpago --
		declare @codigo char(10);
		set @codigo = dbo.Gencodwhats();
		exec sp_insertar_whatsapp_movil_renovacion_postpago @codigo,'73179455','prueba renovacion postpago','45782356','956231548','1','50% renovacion','2','968754857','Prepago','1','89','S22','Cuotas','21456569','0','Solo pregunto precios','Antahualpa','Lomas'
		select * from whatsapp
		-- movil renovacion prepago --
		declare @codigo char(10);
		set @codigo = dbo.Gencodwhats();
		exec sp_insertar_whatsapp_movil_renovacion_prepago @codigo,'73179455','prueba renovacion prepago','12345678','123456789','1','---','2','968754857','Prepago','0','Chip','Contado','12457889','1','sin problemas','por ahi','lo mismo'
		select * from whatsapp
-- pruebas edicion de clientes --
	-- edicion de ventas fija --
		-- fija nueva linea --
		exec sp_editar_whatsapp_fija_lineanueva 'WP00000001','73179455','prueba editando','12345678','9876542313','0','lineas fijas','0','3 Play','HFC','Contado','12345678','1','prueba de edicion','ubicado editado','distrito editado'
		select * from whatsapp
		-- fija portabilidad --
		exec sp_editar_whatsapp_fija_portabilidad 'WP00000002','73179455','editando usuario pueba fija port','87654321','123456789','0','50% dsct en fija','1','654578','1 Play','IFI','Contado','78895645','0','No requirió el servicio','sin señal','no distric'
		select * from whatsapp
	-- edicion de ventas movil --
		-- movil linea nueva postpago --
		exec sp_editar_whatsapp_movil_lineanueva_postpago 'WP00000003','73179455','editando prueba movil lnP','56897845','987451256','1','---','0','1','99','a52','Cuotas','98452648','1','editado compro sin problemas','en su casa','un distrito'
		select * from whatsapp
		-- movil linea nueva prepago --
		exec sp_editar_whatsapp_movil_lineanueva_prepago 'WP00000004','73179455','editando prueba cliente ln Prepa','12345678','987654321','1','Lineas Adicionales','0','0','Chip','Contado','48575968','2','verificacion de la sec','chiclayo','chiclayo'
		select * from whatsapp
		-- movil portabilidad postpago --
		exec sp_editar_whatsapp_movil_portabilidad_postpago 'WP00000005','73179455','editando user prueba porta post','12345678','123456789','1','20% portabilidad','1','985645128','Prepago','Bitel','1','29','huawei','Cuotas','45789856','2','observacion','ubicacion','su distriito'
		select * from whatsapp
		-- movil portabilidad prepago --
		exec sp_editar_whatsapp_movil_portabilidad_prepago 'WP00000006','73179455','editando user prueba porta en pre','45789856','895678451','1','---','1','956784523','Prepago','Movistar','0','Chip','Contado','45788956','1','sin observacion','con ubicaicon','distrito'
		select * from whatsapp
		-- movil renovaion postpago --
		exec sp_editar_whatsapp_movil_renovacion_postpago 'WP00000007','73179455','editando prueba renovacion postpago','45782356','956231548','1','50% renovacion','2','968754857','Prepago','1','89','S22','Cuotas','21456569','0','Solo pregunto precios','Antahualpa','Lomas'
		select * from whatsapp
		-- movil renovacion prepago --
		exec sp_editar_whatsapp_movil_renovacion_prepago 'WP00000008','73179455','editando prueba renovacion prepago','12345678','123456789','1','---','2','968754857','Prepago','0','Chip','Contado','12457889','1','sin problemas','por ahi','lo mismo'
		select * from whatsapp
