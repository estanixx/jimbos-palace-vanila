-- ####################################################################
-- #                          TABLA CONTRATO                          #
-- ####################################################################

CREATE TABLE contrato (
    no_contrato NUMERIC PRIMARY KEY,
    fecha_inicio DATE NOT NULL,
    fecha_fin DATE NOT NULL,
    salary NUMERIC NOT NULL,
    CHECK (fecha_fin >= fecha_inicio),
    CHECK (salary > 0)
);

-- ####################################################################
-- #                  TABLA TIPO DE JUEGO DE MESA                     #
-- ####################################################################

CREATE TABLE tipo_juego_de_mesa(
  codigo NUMERIC PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL
);

-- ####################################################################
-- #                           TABLA JUEGO                            #
-- ####################################################################

CREATE TABLE juego(
  codigo NUMERIC PRIMARY KEY,
  nombre_oficial VARCHAR(100) NOT NULL
);
CREATE TABLE juego_mesa(
  codigo NUMERIC PRIMARY KEY,
  quorum_maximo NUMERIC NOT NULL,
  cod_tipo_juego NUMERIC NOT NULL,
  FOREIGN KEY (cod_tipo_juego) REFERENCES tipo_juego_de_mesa(codigo) ON DELETE RESTRICT,
  FOREIGN KEY (codigo) REFERENCES juego(codigo) ON DELETE RESTRICT,
  CHECK (quorum_maximo > 0)
);
CREATE TABLE tragamonedas(
  codigo NUMERIC PRIMARY KEY,
  fabricante VARCHAR(100) NOT NULL,
  numero_serie NUMERIC NOT NULL,
  monto NUMERIC NOT NULL,
  tematica VARCHAR(100) NOT NULL,
  FOREIGN KEY (codigo) REFERENCES juego(codigo) ON DELETE RESTRICT,
  CHECK (monto > 0),
  CHECK (numero_serie > 0)
);

-- ####################################################################
-- #                           TABLA CLIENTE                          #
-- ####################################################################

CREATE TABLE cliente (
  codigo NUMERIC PRIMARY KEY,
  nombre_completo VARCHAR(255) NOT NULL,
  fecha_nacimiento DATE NOT NULL,
  nivel_lealtad VARCHAR(50) NOT NULL,
  saldo_puntos NUMERIC NOT NULL,
  CHECK (nivel_lealtad IN ('BRONCE', 'PLATA', 'ORO')),
  CHECK (saldo_puntos >= 0)
);

-- ####################################################################
-- #                      TABLA ACCION JUGADOR                        #
-- ####################################################################

CREATE TABLE accion_jugador(
  id NUMERIC PRIMARY KEY,
  hora_inicio TIME NOT NULL,
  fecha DATE NOT NULL,
  tipo VARCHAR(50) NOT NULL,
  hora_fin TIME NULL,
  cod_cliente NUMERIC NOT NULL,
  cod_juego_mesa NUMERIC NULL,
  cod_tragamonedas NUMERIC NULL,
  FOREIGN KEY (cod_cliente) REFERENCES cliente(codigo) ON DELETE RESTRICT,
  FOREIGN KEY (cod_juego_mesa) REFERENCES juego_mesa(codigo) ON DELETE RESTRICT,
  FOREIGN KEY (cod_tragamonedas) REFERENCES tragamonedas(codigo) ON DELETE RESTRICT,
  CHECK (hora_fin IS NULL OR hora_fin > hora_inicio),
  CHECK (tipo IN ('RONDA', 'TURNO')),
  CHECK (
    (tipo = 'RONDA' AND hora_fin IS NOT NULL AND cod_juego_mesa IS NOT NULL) OR
    (tipo != 'RONDA')
  ),
  CHECK (
    (tipo = 'TURNO' AND cod_tragamonedas IS NOT NULL) OR
    (tipo != 'TURNO')
  )
);

-- ####################################################################
-- #                          TABLA APUESTA                          #
-- ####################################################################

CREATE TABLE apuesta(
  codigo NUMERIC PRIMARY KEY,
  monto_dinero NUMERIC NOT NULL,
  fecha DATE NOT NULL,
  hora TIME NOT NULL,
  id_accion_jugador NUMERIC NOT NULL,
  FOREIGN KEY (id_accion_jugador) REFERENCES accion_jugador(id) ON DELETE RESTRICT,
  CHECK (monto_dinero > 0)
);

-- ####################################################################
-- #                          TABLA TORNEO                            #
-- ####################################################################

CREATE TABLE torneo(
    id NUMERIC PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    fecha_inicio DATE NOT NULL,
    fecha_fin DATE NOT NULL,
    pozo_premios NUMERIC NOT NULL,
    cod_cliente NUMERIC NULL,
    id_torneo_clasificatorio NUMERIC NULL,
    FOREIGN KEY (cod_cliente) REFERENCES cliente(codigo) ON DELETE RESTRICT,
    FOREIGN KEY (id_torneo_clasificatorio) REFERENCES torneo(id) ON DELETE SET NULL,
    CHECK (id != id_torneo_clasificatorio),
    CHECK (fecha_inicio <= fecha_fin),
    CHECK (pozo_premios > 0)
);

-- ####################################################################
-- #                          TABLA EMPLEADO                          #
-- ####################################################################

CREATE TABLE empleado (
    codigo NUMERIC PRIMARY KEY,
    nombre_completo VARCHAR(255) NOT NULL,
    codigo_mentor NUMERIC NULL,
    tipo VARCHAR(50) NOT NULL,
    area_asignada VARCHAR(100),
    codigo_certificacion NUMERIC NULL,
    años_experiencia NUMERIC NULL,
    cod_juego_certificado NUMERIC NULL,
    no_contrato NUMERIC NULL,
    FOREIGN KEY (cod_juego_certificado) REFERENCES tipo_juego_de_mesa(codigo) ON DELETE RESTRICT,
    FOREIGN KEY (codigo_mentor) REFERENCES empleado(codigo) ON DELETE SET NULL,
    FOREIGN KEY (no_contrato) REFERENCES contrato(no_contrato) ON DELETE CASCADE,
    CHECK (tipo IN ('CRUPIER', 'JEFE DE SALA')),
    CHECK (codigo != codigo_mentor),
    CHECK (
        (tipo = 'JEFE DE SALA' AND area_asignada IS NOT NULL AND codigo_certificacion IS NOT NULL) OR
        (tipo != 'JEFE DE SALA')
    ),
    CHECK (
        (tipo = 'CRUPIER' AND años_experiencia IS NOT NULL AND cod_juego_certificado IS NOT NULL) OR
        (tipo != 'CRUPIER')
    )
);

-- ####################################################################
-- #                        TABLA TRANSACCION                         #
-- ####################################################################

CREATE TABLE transaccion (
    codigo NUMERIC PRIMARY KEY,
    cod_cliente NUMERIC NOT NULL,
    codigo_encargado NUMERIC NOT NULL,
    codigo_revisor NUMERIC NULL,
    monto_dinero NUMERIC NOT NULL,
    fecha DATE NOT NULL,
    hora TIME NOT NULL,
    tipo VARCHAR(50) NOT NULL,
    cantidad_fichas NUMERIC,
    id_torneo NUMERIC NULL,
    FOREIGN KEY (codigo_encargado) REFERENCES empleado(codigo),
    FOREIGN KEY (id_torneo) REFERENCES torneo(id) ON DELETE SET NULL,
    FOREIGN KEY (codigo_revisor) REFERENCES empleado(codigo),
    FOREIGN KEY (cod_cliente) REFERENCES cliente(codigo) ON DELETE RESTRICT,
    CHECK (codigo_revisor <> codigo_encargado),
    CHECK (tipo IN ('CANJE FICHAS', 'COMPRA FICHAS', 'INSCRIPCION')),
    CHECK (
        (tipo IN ('CANJE FICHAS', 'COMPRA FICHAS') AND cantidad_fichas IS NOT NULL) OR
        (tipo NOT IN ('CANJE FICHAS', 'COMPRA FICHAS'))
    ),
    CHECK (
        (tipo = 'INSCRIPCION' AND id_torneo IS NOT NULL) OR
        (tipo != 'INSCRIPCION')
    ),
    CHECK (monto_dinero > 0)
);