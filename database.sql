/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  cdieg
 * Created: 05-mar-2020
 */

CREATE TABLE USERS (
  id BIGINT(20) NOT NULL AUTO_INCREMENT,
  name VARCHAR(30) NULL,
  lastname VARCHAR(30) NULL,
  identificacion VARCHAR(12) NULL,
  ciudad VARCHAR(120) NULL,
  direccion VARCHAR(120) NULL,
  telefono VARCHAR(15) NULL,
  email VARCHAR(150) NULL,
  email_verified_at VARCHAR(255) NULL,
  password VARCHAR(255) NULL,
  estado INTEGER NOT NULL,
  fecha_vencimiento DATE NULL,
  remember_token VARCHAR(255) NULL,
  created_at DATETIME NULL,
  updated_at DATETIME NULL,
  CONSTRAINT pk_user PRIMARY KEY(id)
)ENGINE=InnoDb;

CREATE TABLE EMPRESAS (
  id INT NOT NULL AUTO_INCREMENT,
  id_user INT NOT NULL,
  nit VARCHAR(20) NULL,  
  nombre_empresa VARCHAR(255) NULL,
  direccion_empresa VARCHAR(100) NULL,
  logo_empresa VARCHAR(255) NULL,
  representante_legal VARCHAR(150) NULL,
  telefono varchar(15),
  created_at DATETIME NULL,
  updated_at DATETIME NULL,
  CONSTRAINT pk_empresas PRIMARY KEY(id),
  CONSTRAINT fk_empresa_user FOREIGN KEY(id_user) REFERENCES users(id)
)ENGINE=InnoDb;


/*
* sin verificar
*/
CREATE TABLE PAISES (
  id INTEGER NOT NULL AUTO_INCREMENT,
  codigo_pais VARCHAR(2) NULL,
  nombre_pais VARCHAR(100) NULL,
  created_at DATETIME NULL,
  updated_at DATETIME NULL,
  CONSTRAINT pk_paises PRIMARY KEY(id)
)ENGINE=InnoDb;

CREATE TABLE FINANCIAMIENTO (
  id INTEGER NOT NULL AUTO_INCREMENT,
  contrato_id integer not null,
  cuota_inicial DOUBLE NULL,
  saldo_restante DOUBLE NULL,
  No_cuotas_financiar INT NULL,
  valor_cuota DOUBLE NULL,
  created_at DATETIME NULL,
  updated_at DATETIME NULL,
  CONSTRAINT pk_financiemiento PRIMARY KEY(id),
  CONSTRAINT fk_contrato_fimanciamiemto FOREIGN KEY(contrato_id)
    REFERENCES CONTRATOS(id)
)ENGINE=InnoDb;

CREATE TABLE ROLES (
  id INTEGER NOT NULL AUTO_INCREMENT,
  nombre_rol VARCHAR(30) NULL,
  created_at DATETIME NULL,
  updated_at DATETIME NULL,
  CONSTRAINT pk_roles PRIMARY KEY(id)
)ENGINE=InnoDb;

CREATE TABLE ESTADO_PROYECTO (
  id INTEGER NOT NULL AUTO_INCREMENT,
  nombre_estado VARCHAR(30) NULL,
  created_at DATETIME NULL,
  updated_at DATETIME NULL,
  CONSTRAINT pk_estado_proyecto PRIMARY KEY(id)
)ENGINE=InnoDb;

CREATE TABLE TIPOS_DE_PROYECTOS (
  id INT NOT NULL AUTO_INCREMENT,
  nombre_servicio VARCHAR(150) NULL,
  created_ad DATETIME NULL,
  updated_at DATETIME NULL,
  CONSTRAINT pk_tipos_de_proyecto PRIMARY KEY(id)
)ENGINE=InnoDb;

CREATE TABLE TIPO_EGRESOS (
  id INTEGER NOT NULL AUTO_INCREMENT,
  nombre_tipo_egreso VARCHAR(150),
  created_at DATETIME NULL,
  updated_at DATETIME NULL,
  CONSTRAINT pk_tipo_egresos PRIMARY KEY(id)
)ENGINE=InnoDb;

CREATE TABLE ROL_PERSONA (
  id INTEGER NOT NULL AUTO_INCREMENT,
  nombre_rol_persona VARCHAR(30) NULL,
  created_at DATETIME NULL,
  updated_at DATETIME NULL,
  CONSTRAINT pk_rol_persona PRIMARY KEY(id)
)ENGINE=InnoDb;

CREATE TABLE ESTADO_PROPUESTA (
  id INTEGER NOT NULL AUTO_INCREMENT,
  nombre_tipo_propuesta VARCHAR(150) NULL,
  created_at DATE NULL,
  updated_at DATE NULL,
  CONSTRAINT pk_estado_propuesta PRIMARY KEY(id)
)ENGINE=InnoDb;

CREATE TABLE USERS (
  id INTEGER NOT NULL AUTO_INCREMENT,
  username VARCHAR(20) NULL,
  passwd VARCHAR(20) NULL,
  estado INTEGER NULL,
  stripe_id VARCHAR(255) NULL,
  card_brand VARCHAR(255) NULL,
  card_last_four VARCHAR(255) NULL,
  trial_ends_at TIMESTAMP NULL,
  remember_token VARCHAR(255) NULL,
  created_at DATETIME NULL,
  updated_at DATETIME NULL,
  CONSTRAINT pk_user PRIMARY KEY(id)
)ENGINE=InnoDb;

CREATE TABLE CONTRATOS (
  id INTEGER NOT NULL AUTO_INCREMENT,
  fecha_contrato DATE NULL,
  fin_contrato DATE NULL,
  precio_contrato DOUBLE NULL,
  texto_contrato TEXT NULL,
  contrato_firmado INT NULL,
  archivo_contrato VARCHAR(255) NULL,
  pagado_totalidad INT NULL,
  created_at DATETIME NULL,
  updated_at DATETIME NULL,
  CONSTRAINT pk_contrato PRIMARY KEY(id)
)ENGINE=InnoDb;

CREATE TABLE INGRESOS (
  id INTEGER NOT NULL AUTO_INCREMENT,
  FINANCIAMIENTO_id INTEGER NOT NULL,
  No_couta_pagar VARCHAR(12) NULL,
  couta_pagada INT NULL,
  vencimiento_cuota DATE NULL,
  created_at DATETIME NULL,
  updated_at DATETIME NULL,
  CONSTRAINT pk_ingresos PRIMARY KEY(id),
  CONSTRAINT fk_financiemiaeto_ingresos FOREIGN KEY(FINANCIAMIENTO_id)
    REFERENCES FINANCIAMIENTO(id)
)ENGINE=InnoDb;

CREATE TABLE ESTADOS (
  id INTEGER NOT NULL AUTO_INCREMENT,
  pais_id INTEGER NOT NULL,
  codigo_estado VARCHAR(10) NULL,
  nombre_estado VARCHAR(100) NULL,
  created_at DATETIME NULL,
  updated_at DATETIME NULL,
  CONSTRAINT pk_estados PRIMARY KEY(id),
  CONSTRAINT fk_pais_estado FOREIGN KEY(pais_id)
    REFERENCES PAISES(id)
)ENGINE=InnoDb;

CREATE TABLE PROYECTO (
  id INTEGER NOT NULL AUTO_INCREMENT,
  ESTADO_PROYECTO_id INTEGER NOT NULL,
  TIPOS_DE_PROYECTOS_id INT NOT NULL,
  CONTRATOS_id INTEGER NOT NULL,
  nombre_proyecto VARCHAR(150) NULL,
  fecha_inicio DATE NULL,
  fecha_fin DATE NULL,
  createt_at DATETIME NULL,
  updated_at DATETIME NULL,
  CONSTRAINT pk_proyecto PRIMARY KEY(id),
  CONSTRAINT fk_contrato_proyecto FOREIGN KEY(CONTRATOS_id)
    REFERENCES CONTRATOS(id),
  CONSTRAINT fk_tipoProyecto_proyecto FOREIGN KEY(TIPOS_DE_PROYECTOS_id)
    REFERENCES TIPOS_DE_PROYECTOS(id),
  CONSTRAINT fk_estadoProyecto_proyecto FOREIGN KEY(ESTADO_PROYECTO_id)
    REFERENCES ESTADO_PROYECTO(id)
)ENGINE=InnoDb;

CREATE TABLE CIUDADES (
  id INTEGER NOT NULL AUTO_INCREMENT,
  ESTADOS_id INTEGER NOT NULL,
  codigo_ciudad VARCHAR(10) NULL,
  nombre_ciudad VARCHAR(150) NULL,
  created_at DATETIME NULL,
  updated_at DATETIME NULL,
  CONSTRAINT pk_ciudades PRIMARY KEY(id),
  CONSTRAINT fk_estado_ciudad FOREIGN KEY(ESTADOS_id)
    REFERENCES ESTADOS(id)
)ENGINE=InnoDb;

CREATE TABLE PERSONAS (
  id INT NOT NULL AUTO_INCREMENT,
  ROLES_id INTEGER NOT NULL,
  CIUDADES_id INTEGER NOT NULL,
  user_id INTEGER NULL,
  tipo_documento Varchar(100) null,
  No_documento Varchar(15) null,
  nombres_persona VARCHAR(100) NULL,
  apellidos_persona VARCHAR(100) NULL,
  direccion_persona VARCHAR(100) NULL,
  telefono_persona VARCHAR(13) NULL,
  email_persona VARCHAR(100) NULL,
  expedicion_documento VARCHAR(100) NULL,
  cargo_en_empresa VARCHAR(150) NULL,
  created_at DATETIME NULL,
  updated_at DATETIME NULL,
  CONSTRAINT pk_personas PRIMARY KEY(id),
  CONSTRAINT fk_ciudad_persona FOREIGN KEY(CIUDADES_id)
    REFERENCES CIUDADES(id),
  CONSTRAINT fk_rol_persona FOREIGN KEY(ROLES_id)
    REFERENCES ROLES(id),
  CONSTRAINT fk_user_persona FOREIGN KEY(user_id)
    REFERENCES users(id)
)ENGINE=InnoDb;

CREATE TABLE PROPUESTAS (
  id INTEGER NOT NULL AUTO_INCREMENT,
  PERSONAS_id INT NOT NULL,
  ESTADO_PROPUESTA_id INTEGER NOT NULL,
  nombre VARCHAR(150) NULL,
  descripcion TEXT NULL,
  created_at DATETIME NULL,
  updated_at DATETIME NULL,
  CONSTRAINT pk_propuestas PRIMARY KEY(id),
  CONSTRAINT fk_estadoPropuesta_propuesta FOREIGN KEY(ESTADO_PROPUESTA_id)
    REFERENCES ESTADO_PROPUESTA(id),
  CONSTRAINT fk_persona_propuesta FOREIGN KEY(PERSONAS_id)
    REFERENCES PERSONAS(id)
)ENGINE=InnoDb;

CREATE TABLE PERSONAS_has_CONTRATOS (
  id INTEGER NOT NULL AUTO_INCREMENT,
  CONTRATOS_id INTEGER NOT NULL,
  PERSONAS_id INT NOT NULL,
  ROL_PERSONA_id INTEGER NOT NULL,
  created_at DATETIME NULL,
  updated_at DATETIME NULL,
  CONSTRAINT pk_personas_has_contratos PRIMARY KEY(id, CONTRATOS_id, PERSONAS_id),
  CONSTRAINT fk_persona_personaContrato FOREIGN KEY(PERSONAS_id)
    REFERENCES PERSONAS(id),
  CONSTRAINT fk_contrato_personaContrato FOREIGN KEY(CONTRATOS_id)
    REFERENCES CONTRATOS(id),
  CONSTRAINT fk_rolPersona_personaContrato FOREIGN KEY(ROL_PERSONA_id)
    REFERENCES ROL_PERSONA(id)
)ENGINE=InnoDb;

CREATE TABLE RESPUESTAS (
  id INTEGER NOT NULL AUTO_INCREMENT,
  PROPUESTAS_id INTEGER NOT NULL,
  nombre VARCHAR(100) NULL,
  descripcion_respuesta TEXT,
  created_at DATETIME NULL,
  updated_at DATETIME NULL,
  CONSTRAINT pk_respuestas PRIMARY KEY(id),
  CONSTRAINT fk_propuesta_respuesta FOREIGN KEY(PROPUESTAS_id)
    REFERENCES PROPUESTAS(id)
)ENGINE=InnoDb;

CREATE TABLE FORMATOS_DE_COTRATOS (
  id INT NOT NULL AUTO_INCREMENT,
  PERSONAS_id INT NOT NULL,
  nombre_contrato VARCHAR(150) NULL,
  texto_de_contrato TEXT NULL,
  created_at DATETIME NULL,
  updated_at DATETIME NULL,
  CONSTRAINT pk_formatos PRIMARY KEY(id),
  CONSTRAINT fk_persona_formatoContrato FOREIGN KEY(PERSONAS_id)
    REFERENCES PERSONAS(id)
)ENGINE=InnoDb;

CREATE TABLE EMPRESAS (
  id INT NOT NULL AUTO_INCREMENT,
  PERSONAS_id INT NOT NULL,
  nit VARCHAR(50) NULL,  
  nombre_empresa VARCHAR(255) NULL,
  direccion_empresa VARCHAR(100) NULL,
  logo_empresa VARCHAR(255) NULL,
  representante_legal VARCHAR(255) NULL,
  telefono varchar(13),
  created_at DATETIME NULL,
  updated_at DATETIME NULL,
  CONSTRAINT pk_empresas PRIMARY KEY(id),
  CONSTRAINT fk_persona_empresa FOREIGN KEY(PERSONAS_id)
    REFERENCES PERSONAS(id)
)ENGINE=InnoDb;

CREATE TABLE SUBSCRIPTIONS (
  id INTEGER NOT NULL AUTO_INCREMENT,
  user_id INTEGER NOT NULL,
  name_subscription VARCHAR(255) NULL,
  stripe_id VARCHAR(255) NULL,
  stripe_plan VARCHAR(255) NULL,
  quantity INT NULL,
  trial_ends_at TIMESTAMP NULL,
  ends_at TIMESTAMP NULL,
  created_at TIMESTAMP NULL,
  updated_at INTEGER UNSIGNED NULL,
  CONSTRAINT pk_subcriptions PRIMARY KEY(id),
  CONSTRAINT fk_user_subcription FOREIGN KEY(user_id)
    REFERENCES users(id)
)ENGINE=InnoDb;

CREATE TABLE USER_SOCIAL_ACCOUNTS (
  id INT NOT NULL AUTO_INCREMENT,
  user_id INTEGER NOT NULL,
  provider VARCHAR(255) NULL,
  provider_uid VARCHAR(255) NULL,
  created_at DATETIME NULL,
  updated_at DATETIME NULL,
  CONSTRAINT pk_user_social_account PRIMARY KEY(id),
  CONSTRAINT fk_user_socialAccount  FOREIGN KEY(user_id)
    REFERENCES users(id)
)ENGINE=InnoDb;

CREATE TABLE EGRESOS (
  id INTEGER NOT NULL AUTO_INCREMENT,
  TIPO_EGRESO_id INTEGER NOT NULL,
  EMPRESAS_id INT NOT NULL,
  monto_egreso DOUBLE NULL,
  descripcion TEXT NULL,
  pagado_a VARCHAR(150) NULL,
  created_at DATETIME NULL,
  update_at DATETIME NULL,
  CONSTRAINT pk_egresos PRIMARY KEY(id),
  CONSTRAINT fk_empresa_egreso FOREIGN KEY(EMPRESAS_id)
    REFERENCES EMPRESAS(id),
  CONSTRAINT fk_tipoEgreso_egreso FOREIGN KEY(TIPO_EGRESO_id)
    REFERENCES TIPO_EGRESOS(id)
)ENGINE=InnoDb;
