/************************************************************************/
/*  OBJETO: cript de creacion de asistente para Transferencia Local    */
/*  DESCRIPCION:                                                         */
/*  Creacion de Asiste para Transferencias Locales            */
/*                                    */
/*                        MODIFICACIONES                                 */
/*                                                                       */
/*  FECHA          CREACION            RAZON        */
/*                                      */
/*  2021-07-20        Diego Hinojosa      Creación      */
/* VERSION      2                                                  */
/************************************************************************/

USE pr_canales
GO

SET NOCOUNT ON
GO

IF EXISTS(SELECT 1 FROM [pr_canales].[dbo].[wp_asistente] WHERE as_flujo = 'TransferenciaLocal')
BEGIN
  DELETE FROM dbo.wp_asistente_idioma WHERE as_id_asistente in (
    SELECT as_id_asistente FROM [pr_canales].[dbo].[wp_asistente] WHERE as_flujo = 'TransferenciaLocal'
  )

  DELETE FROM [pr_canales].[dbo].[wp_asistente] WHERE as_flujo = 'TransferenciaLocal'
END


DECLARE @id_ruta_presenta INT
SET @id_ruta_presenta = 0

DECLARE @id_menu_presenta INT
SET @id_menu_presenta = 0

DECLARE @id_idioma_es INT, @id_idioma_en INT
---------------------------------------------------- WP_MENU_IDIOMA ---------------------------------------------

SELECT @id_idioma_es = id_id_idioma FROM dbo.wp_idioma WHERE id_nemonico = 'es-EC'
SELECT @id_idioma_en = id_id_idioma FROM dbo.wp_idioma WHERE id_nemonico = 'en-US'

-----------------------------------------------------------------------------------------------------------------
/*1.- Transferencia Local*/
---------------------------------------------------- WP_RUTA ----------------------------------------------------
IF NOT EXISTS(SELECT 1 FROM dbo.wp_ruta WHERE ru_direccion = 'Transferencia/Contacto/{contacto}' AND ru_canal = 'IN' AND ru_verbo = 'GET')
BEGIN
  INSERT INTO dbo.wp_ruta(ru_canal, ru_verbo, ru_direccion, ru_recurso, ru_estado, ru_fecha)
  VALUES ('IN', 'GET', 'Transferencia/Contacto/{contacto}', NULL, 'ACT', GETDATE())

  SELECT @id_ruta_presenta = @@IDENTITY
END
ELSE
BEGIN
  PRINT ('Ya existe la ruta Transferencia/Contacto/{contacto} en wp_ruta')
  SELECT @id_ruta_presenta = ru_id_ruta FROM dbo.wp_ruta WHERE ru_direccion = 'Transferencia/Contacto/{contacto}' AND ru_canal = 'IN' AND ru_verbo = 'GET'
END

select 'Contactos WP_RUTA: ' + convert(varchar,@id_ruta_presenta) as respuesta

---------------------------------------------------- WP_MENU ----------------------------------------------------
IF NOT EXISTS(SELECT 1 FROM dbo.wp_menu WHERE ru_id_ruta = @id_ruta_presenta)
BEGIN
  INSERT INTO dbo.wp_menu (ru_id_ruta, me_id_padre, me_orden, me_critica, me_visible, me_favorito, me_icono, me_estado, me_fecha)
  VALUES (@id_ruta_presenta, 0, 1, 0, 0, 0, NULL,'ACT', GETDATE())

  SELECT @id_menu_presenta = @@IDENTITY
END
ELSE
BEGIN
  PRINT ('Ya existe la ruta Transferencia/Contacto/{contacto} en wp_menu')
  SELECT @id_menu_presenta = me_id_menu FROM dbo.wp_menu WHERE ru_id_ruta = @id_ruta_presenta
END

select 'Contactos WP_MENU: ' + convert(varchar,@id_menu_presenta) as respuesta

---------------------------------------------------- WP_MENU_IDIOMA ----------------------------------------------------
-- es-EC --
IF NOT EXISTS(SELECT 1 FROM dbo.wp_menu_idioma WHERE me_id_menu = @id_menu_presenta AND id_id_idioma = @id_idioma_es)
BEGIN
  INSERT INTO dbo.wp_menu_idioma (id_id_idioma, me_id_menu, mi_nombre, mi_etiqueta)
  VALUES (@id_idioma_es, @id_menu_presenta, 'Transferencia local', NULL)
END
ELSE
BEGIN
  PRINT ('Ya existe la ruta Transferencia/Contacto/{contacto} en wp_menu_idioma / es-EC')
END

-- en-US --
IF NOT EXISTS(SELECT 1 FROM dbo.wp_menu_idioma WHERE me_id_menu = @id_menu_presenta AND id_id_idioma = @id_idioma_en)
BEGIN
  INSERT INTO dbo.wp_menu_idioma (id_id_idioma, me_id_menu, mi_nombre, mi_etiqueta)
  VALUES (@id_idioma_en, @id_menu_presenta, 'Local transfer', NULL)
END
ELSE
BEGIN
  PRINT ('Ya existe la ruta Transferencia/Contacto/{contacto} en wp_menu_idioma / en-US')
END

-----------------------------------------------------------------------------------------------------------------
DECLARE @id_ruta_asistente INT, @id_ruta_origen INT, @id_ruta_cancelar INT, @id_ruta_continuar INT, @id_asistente INT

DECLARE @id_ruta_editar_post INT
SET @id_ruta_editar_post = 0

DECLARE @id_menu_editar_post INT
SET @id_menu_editar_post = 0


---------------------------------------------------- WP_RUTA ----------------------------------------------------
IF NOT EXISTS(SELECT 1 FROM dbo.wp_ruta WHERE ru_direccion = '/Transferencia/Transferencia/Local/Crear' AND ru_canal = 'IN' AND ru_verbo = 'POST')
BEGIN
  INSERT INTO dbo.wp_ruta(ru_canal, ru_verbo, ru_direccion, ru_recurso, ru_estado, ru_fecha)
  VALUES ('IN', 'POST', '/Transferencia/Transferencia/Local/Crear', NULL, 'ACT', GETDATE())

  SELECT @id_ruta_editar_post = @@IDENTITY
END
ELSE
BEGIN
  PRINT ('Ya existe la ruta /Transferencia/Transferencia/Local/Crear en wp_ruta')
  SELECT @id_ruta_editar_post = ru_id_ruta FROM dbo.wp_ruta WHERE ru_direccion = '/Transferencia/Transferencia/Local/Crear' AND ru_canal = 'IN' AND ru_verbo = 'POST'
END

select 'Contactos ContactosNacional POST WP_RUTA: ' + convert(varchar,@id_ruta_editar_post) as respuesta

---------------------------------------------------- WP_MENU ----------------------------------------------------
IF NOT EXISTS(SELECT 1 FROM dbo.wp_menu WHERE ru_id_ruta = @id_ruta_editar_post)
BEGIN
  INSERT INTO dbo.wp_menu (ru_id_ruta, me_id_padre, me_orden, me_critica, me_visible, me_favorito, me_icono, me_estado, me_fecha)
  VALUES (@id_ruta_editar_post, 0, 1, 0, 0, 0, NULL,'ACT', GETDATE())

  SELECT @id_menu_editar_post = @@IDENTITY
END
ELSE
BEGIN
  PRINT ('Ya existe la ruta /Transferencia/Transferencia/Local/Crear en wp_menu')
  SELECT @id_menu_editar_post = me_id_menu FROM dbo.wp_menu WHERE ru_id_ruta = @id_ruta_editar_post
END

select 'Contactos ContactosNacional POST WP_MENU: ' + convert(varchar,@id_menu_editar_post) as respuesta

---------------------------------------------------- WP_MENU_IDIOMA ----------------------------------------------------
-- es-EC --
IF NOT EXISTS(SELECT 1 FROM dbo.wp_menu_idioma WHERE me_id_menu = @id_menu_editar_post AND id_id_idioma = @id_idioma_es)
BEGIN
  INSERT INTO dbo.wp_menu_idioma (id_id_idioma, me_id_menu, mi_nombre, mi_etiqueta)
  VALUES (@id_idioma_es, @id_menu_editar_post, 'Procesar', NULL)
END
ELSE
BEGIN
  PRINT ('Ya existe la ruta /Transferencia/Transferencia/Local/Crear en wp_menu_idioma / es-EC')
END

-- en-US --
IF NOT EXISTS(SELECT 1 FROM dbo.wp_menu_idioma WHERE me_id_menu = @id_menu_editar_post AND id_id_idioma = @id_idioma_en)
BEGIN
  INSERT INTO dbo.wp_menu_idioma (id_id_idioma, me_id_menu, mi_nombre, mi_etiqueta)
  VALUES (@id_idioma_en, @id_menu_editar_post, 'Procesar', NULL)
END
ELSE
BEGIN
  PRINT ('Ya existe la ruta /Transferencia/Transferencia/Local/Crear en wp_menu_idioma / en-US')
END
------------------------------------------------------------------------------------------------------------------------

-----------------------------------------------------------------------------------------------------------------
---------------------------------------------------- PASO 1 -----------------------------------------------------
-----------------------------------------------------------------------------------------------------------------

---------------------------------------------------- WP_MENU_IDIOMA ---------------------------------------------

SELECT @id_ruta_asistente = ru_id_ruta FROM dbo.wp_ruta WHERE ru_direccion = '/Transferencia/Contacto/{contacto}' AND ru_canal = 'IN'
SELECT @id_ruta_origen = ru_id_ruta FROM dbo.wp_ruta WHERE ru_direccion = '/Transferencia/Transferencias' AND ru_canal = 'IN'
SELECT @id_ruta_cancelar = ru_id_ruta FROM dbo.wp_ruta WHERE ru_direccion = '/Transferencia/Transferencias' AND ru_canal = 'IN'
SELECT @id_ruta_continuar = ru_id_ruta FROM dbo.wp_ruta WHERE ru_direccion = '/Transferencia/Asistentes/Confirmaciones' AND ru_canal = 'IN'
IF NOT EXISTS(SELECT 1 FROM dbo.wp_asistente WHERE ru_id_ruta_asistente = @id_ruta_asistente AND as_flujo = 'TransferenciaLocal' AND as_pasos = 3 AND as_paso_actual = 1)
BEGIN
INSERT INTO dbo.wp_asistente (ru_id_ruta_asistente, ru_id_ruta_origen, ru_id_ruta_cancelar, ru_id_ruta_continuar, as_flujo, as_pasos, as_paso_actual, as_paso_critico, as_estado, as_fecha)
VALUES (@id_ruta_asistente, @id_ruta_origen, @id_ruta_cancelar, @id_ruta_continuar, 'TransferenciaLocal', 3, 1, 0, 'ACT', GETDATE())
END
ELSE
BEGIN
PRINT ('Ya existe asistente para la ruta /Transferencia/Contacto/{contacto} en wp_asistente')
END

SELECT @id_asistente = a.as_id_asistente FROM dbo.wp_asistente a INNER JOIN dbo.wp_ruta r ON a.ru_id_ruta_asistente = r.ru_id_ruta WHERE r.ru_direccion = '/Transferencia/Contacto/{contacto}'
IF NOT EXISTS(SELECT 1 FROM dbo.wp_asistente_idioma WHERE as_id_asistente = @id_asistente AND id_id_idioma = @id_idioma_es)
BEGIN
INSERT INTO dbo.wp_asistente_idioma (id_id_idioma, as_id_asistente, ai_titulo, ai_subtitulo, ai_boton_cancelar, ai_boton_continuar)
VALUES (@id_idioma_es, @id_asistente, 'Transferencia local', 'Información para la transferencia', 'Cancelar', 'Continuar')
END
ELSE
BEGIN
PRINT ('Ya existe asistente_idioma para la ruta /Transferencia/Contacto/{contacto} en wp_asistente_idioma')
END

SELECT @id_asistente = a.as_id_asistente FROM dbo.wp_asistente a INNER JOIN dbo.wp_ruta r ON a.ru_id_ruta_asistente = r.ru_id_ruta WHERE r.ru_direccion = '/Transferencia/Contacto/{contacto}'
IF NOT EXISTS(SELECT 1 FROM dbo.wp_asistente_idioma WHERE as_id_asistente = @id_asistente AND id_id_idioma = @id_idioma_en)
BEGIN
INSERT INTO dbo.wp_asistente_idioma (id_id_idioma, as_id_asistente, ai_titulo, ai_subtitulo, ai_boton_cancelar, ai_boton_continuar)
VALUES (@id_idioma_en, @id_asistente, 'Local transfer', 'Information for the transfer', 'Cancel', 'Continue')
END
ELSE
BEGIN
PRINT ('Ya existe asistente_idioma para la ruta /Transferencia/Contacto/{contacto} en wp_asistente_idioma')
END

-----------------------------------------------------------------------------------------------------------------
---------------------------------------------------- PASO 2 -----------------------------------------------------
-----------------------------------------------------------------------------------------------------------------

SELECT @id_ruta_asistente = ru_id_ruta FROM dbo.wp_ruta WHERE ru_direccion = '/Transferencia/Asistentes/Confirmaciones' AND ru_canal = 'IN'
SELECT @id_ruta_origen = ru_id_ruta FROM dbo.wp_ruta WHERE ru_direccion = '/Transferencia/Contacto/{contacto}' AND ru_canal = 'IN'
SELECT @id_ruta_cancelar = ru_id_ruta FROM dbo.wp_ruta WHERE ru_direccion = '/Transferencia/Transferencias' AND ru_canal = 'IN'
SELECT @id_ruta_continuar = ru_id_ruta FROM dbo.wp_ruta WHERE ru_direccion = '/Transferencia/Transferencia/Local/Crear' AND ru_canal = 'IN'
IF NOT EXISTS(SELECT 1 FROM dbo.wp_asistente WHERE ru_id_ruta_asistente = @id_ruta_asistente AND as_flujo = 'TransferenciaLocal' AND as_pasos = 3 AND as_paso_actual = 2)
BEGIN
INSERT INTO dbo.wp_asistente (ru_id_ruta_asistente, ru_id_ruta_origen, ru_id_ruta_cancelar, ru_id_ruta_continuar, as_flujo, as_pasos, as_paso_actual, as_paso_critico, as_estado, as_fecha)
VALUES (@id_ruta_asistente, @id_ruta_origen, @id_ruta_cancelar, @id_ruta_continuar, 'TransferenciaLocal', 3, 2, 1, 'ACT', GETDATE())
END
ELSE
BEGIN
PRINT ('Ya existe asistente para la ruta /Transferencia/Asistentes/Confirmaciones en wp_asistente')
END

SELECT @id_asistente = a.as_id_asistente FROM dbo.wp_asistente a INNER JOIN dbo.wp_ruta r ON a.ru_id_ruta_asistente = r.ru_id_ruta WHERE r.ru_direccion = '/Transferencia/Asistentes/Confirmaciones'
IF NOT EXISTS(SELECT 1 FROM dbo.wp_asistente_idioma WHERE as_id_asistente = @id_asistente AND id_id_idioma = @id_idioma_es)
BEGIN
INSERT INTO dbo.wp_asistente_idioma (id_id_idioma, as_id_asistente, ai_titulo, ai_subtitulo, ai_boton_cancelar, ai_boton_continuar)
VALUES (@id_idioma_es, @id_asistente, 'Transferencia local', 'Confirmación de datos', 'Cancelar', 'Confirmar transferencia')
END
ELSE
BEGIN
PRINT ('Ya existe asistente_idioma para la ruta /Transferencia/Asistentes/Confirmaciones en wp_asistente_idioma')
END

SELECT @id_asistente = a.as_id_asistente FROM dbo.wp_asistente a INNER JOIN dbo.wp_ruta r ON a.ru_id_ruta_asistente = r.ru_id_ruta WHERE r.ru_direccion = '/Transferencia/Asistentes/Confirmaciones'
IF NOT EXISTS(SELECT 1 FROM dbo.wp_asistente_idioma WHERE as_id_asistente = @id_asistente AND id_id_idioma = @id_idioma_en)
BEGIN
INSERT INTO dbo.wp_asistente_idioma (id_id_idioma, as_id_asistente, ai_titulo, ai_subtitulo, ai_boton_cancelar, ai_boton_continuar)
VALUES (@id_idioma_en, @id_asistente, 'Local transfer', 'Confirmation of data', 'Cancel', 'Confirm transfer')
END
ELSE
BEGIN
PRINT ('Ya existe asistente_idioma para la ruta /Transferencia/Asistentes/Confirmaciones en wp_asistente_idioma')
END

-----------------------------------------------------------------------------------------------------------------
---------------------------------------------------- PASO 3 -----------------------------------------------------
-----------------------------------------------------------------------------------------------------------------

SELECT @id_ruta_asistente = ru_id_ruta FROM dbo.wp_ruta WHERE ru_direccion = '/Transferencia/Asistentes/Resumenes' AND ru_canal = 'IN'
SELECT @id_ruta_origen = ru_id_ruta FROM dbo.wp_ruta WHERE ru_direccion = '/Transferencia/Asistentes/Confirmaciones' AND ru_canal = 'IN'
SELECT @id_ruta_cancelar = ru_id_ruta FROM dbo.wp_ruta WHERE ru_direccion = '' AND ru_canal = 'IN'
SELECT @id_ruta_continuar = ru_id_ruta FROM dbo.wp_ruta WHERE ru_direccion = '/Transferencia/Transferencias' AND ru_canal = 'IN'
IF NOT EXISTS(SELECT 1 FROM dbo.wp_asistente WHERE ru_id_ruta_asistente = @id_ruta_asistente AND as_flujo = 'TransferenciaLocal' AND as_pasos = 3 AND as_paso_actual = 3)
BEGIN
INSERT INTO dbo.wp_asistente (ru_id_ruta_asistente, ru_id_ruta_origen, ru_id_ruta_cancelar, ru_id_ruta_continuar, as_flujo, as_pasos, as_paso_actual, as_paso_critico, as_estado, as_fecha)
VALUES (@id_ruta_asistente, @id_ruta_origen, @id_ruta_cancelar, @id_ruta_continuar, 'TransferenciaLocal', 3, 3, 0, 'ACT', GETDATE())
END
ELSE
BEGIN
PRINT ('Ya existe asistente para la ruta /Transferencia/Asistentes/Resumenes en wp_asistente')
END

SELECT @id_asistente = a.as_id_asistente FROM dbo.wp_asistente a INNER JOIN dbo.wp_ruta r ON a.ru_id_ruta_asistente = r.ru_id_ruta WHERE r.ru_direccion = '/Transferencia/Asistentes/Resumenes'
IF NOT EXISTS(SELECT 1 FROM dbo.wp_asistente_idioma WHERE as_id_asistente = @id_asistente AND id_id_idioma = @id_idioma_es)
BEGIN
INSERT INTO dbo.wp_asistente_idioma (id_id_idioma, as_id_asistente, ai_titulo, ai_subtitulo, ai_boton_cancelar, ai_boton_continuar)
VALUES (@id_idioma_es, @id_asistente, 'Transferencia local', '', '', 'Regresar a transferencias')
END
ELSE
BEGIN
PRINT ('Ya existe asistente_idioma para la ruta /Transferencia/Asistentes/Resumenes en wp_asistente_idioma')
END

SELECT @id_asistente = a.as_id_asistente FROM dbo.wp_asistente a INNER JOIN dbo.wp_ruta r ON a.ru_id_ruta_asistente = r.ru_id_ruta WHERE r.ru_direccion = '/Transferencia/Asistentes/Resumenes'
IF NOT EXISTS(SELECT 1 FROM dbo.wp_asistente_idioma WHERE as_id_asistente = @id_asistente AND id_id_idioma = @id_idioma_en)
BEGIN
INSERT INTO dbo.wp_asistente_idioma (id_id_idioma, as_id_asistente, ai_titulo, ai_subtitulo, ai_boton_cancelar, ai_boton_continuar)
VALUES (@id_idioma_en, @id_asistente, 'Local transfer', '', '', 'Back to transfers')
END
ELSE
BEGIN
PRINT ('Ya existe asistente_idioma para la ruta /Transferencia/Asistentes/Resumenes en wp_asistente_idioma')
END
GO
 