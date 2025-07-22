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
-- #                          TABLA EMPLEADO                          #
-- ####################################################################
CREATE TABLE empleado (
    codigo NUMERIC PRIMARY KEY,
    nombre_completo VARCHAR(255) NOT NULL,
    codigo_mentor NUMERIC,
    tipo VARCHAR(50) NOT NULL,
    area_asignada VARCHAR(100),
    codigo_certificacion NUMERIC,
    años_experiencia NUMERIC,
    juego_certificado VARCHAR(100),
    no_contrato NUMERIC NULL,
    FOREIGN KEY (codigo_mentor) REFERENCES empleado(codigo) ON DELETE SET NULL,
    FOREIGN KEY (no_contrato) REFERENCES contrato(no_contrato) ON DELETE CASCADE,
    CHECK (tipo IN ('CRUPIER', 'JEFE DE SALA')),
    CHECK (codigo <> codigo_mentor),
    CHECK (
        (tipo = 'JEFE DE SALA' AND area_asignada IS NOT NULL AND codigo_certificacion IS NOT NULL) OR
        (tipo != 'JEFE DE SALA')
    ),
    CHECK (
        (tipo = 'CRUPIER' AND años_experiencia IS NOT NULL AND juego_certificado IS NOT NULL) OR
        (tipo != 'CRUPIER')
    )
);

-- ####################################################################
-- #                        TABLA TRANSACCION                         #
-- ####################################################################
CREATE TABLE transaccion (
    codigo NUMERIC PRIMARY KEY,
    nombre_cliente VARCHAR(255) NOT NULL,
    codigo_encargado NUMERIC NOT NULL,
    codigo_revisor NUMERIC NULL,
    monto_dinero NUMERIC NOT NULL,
    fecha DATE NOT NULL,
    hora TIME NOT NULL,
    tipo VARCHAR(50) NOT NULL,
    cantidad_fichas NUMERIC,
    nombre_torneo VARCHAR(150),
    FOREIGN KEY (codigo_encargado) REFERENCES empleado(codigo),
    FOREIGN KEY (codigo_revisor) REFERENCES empleado(codigo),
    CHECK (codigo_revisor <> codigo_encargado),
    CHECK (tipo IN ('CANJE FICHAS', 'COMPRA FICHAS', 'INSCRIPCION')),
    CHECK (
        (tipo IN ('CANJE FICHAS', 'COMPRA FICHAS') AND cantidad_fichas IS NOT NULL) OR
        (tipo NOT IN ('CANJE FICHAS', 'COMPRA FICHAS'))
    ),
    CHECK (
        (tipo = 'INSCRIPCION' AND nombre_torneo IS NOT NULL) OR
        (tipo != 'INSCRIPCION')
    )
);