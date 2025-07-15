-- ####################################################################
-- #                          TABLA CONTRATO                          #
-- ####################################################################
CREATE TABLE contrato (
    no_contrato NUMERIC PRIMARY KEY,
    fecha_inicio DATE NOT NULL,
    fecha_fin DATE NOT NULL,
    salary NUMERIC NOT NULL,
    CONSTRAINT chk_fechas CHECK (fecha_fin >= fecha_inicio),
    CONSTRAINT chk_salary CHECK (salary > 0)
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
    no_contrato NUMERIC NOT NULL,
    CONSTRAINT fk_mentor FOREIGN KEY (codigo_mentor) REFERENCES empleado(codigo) ON DELETE SET NULL,
    CONSTRAINT fk_contrato FOREIGN KEY (no_contrato) REFERENCES contrato(no_contrato) ON DELETE CASCADE,
    CONSTRAINT chk_tipo CHECK (tipo IN ('CRUPIER', 'JEFE DE SALA')),
    CONSTRAINT chk_auto_mentor CHECK (codigo <> codigo_mentor),
    CONSTRAINT chk_jefe_sala CHECK (
        (tipo = 'JEFE DE SALA' AND area_asignada IS NOT NULL AND codigo_certificacion IS NOT NULL) OR
        (tipo != 'JEFE DE SALA')
    ),
    CONSTRAINT chk_crupier CHECK (
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
    codigo_empleado NUMERIC NOT NULL,
    monto_dinero NUMERIC NOT NULL,
    fecha DATE NOT NULL,
    hora TIME NOT NULL,
    tipo VARCHAR(50) NOT NULL,
    cantidad_fichas NUMERIC,
    nombre_torneo VARCHAR(150),
    CONSTRAINT fk_empleado FOREIGN KEY (codigo_empleado) REFERENCES empleado(codigo),
    CONSTRAINT chk_tipo_transaccion CHECK (tipo IN ('CANJE FICHAS', 'COMPRA FICHAS', 'INSCRIPCION')),
    CONSTRAINT chk_fichas CHECK (
        (tipo IN ('CANJE FICHAS', 'COMPRA FICHAS') AND cantidad_fichas IS NOT NULL) OR
        (tipo NOT IN ('CANJE FICHAS', 'COMPRA FICHAS'))
    ),
    CONSTRAINT chk_torneo CHECK (
        (tipo = 'INSCRIPCION' AND nombre_torneo IS NOT NULL) OR
        (tipo != 'INSCRIPCION')
    )
);