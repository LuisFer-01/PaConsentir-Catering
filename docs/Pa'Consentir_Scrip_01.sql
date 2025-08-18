-- -----------------------------------------------------
-- Base de datos: paconsentir
-- -----------------------------------------------------
DROP DATABASE IF EXISTS paconsentir;
CREATE DATABASE paconsentir CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE paconsentir;

-- -----------------------------------------------------
-- Tabla: users (autenticación de Laravel)
-- Campos en inglés por requerimiento
-- -----------------------------------------------------
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    email_verified_at DATETIME NULL,
    password VARCHAR(255) NOT NULL,
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Tabla: roles
-- Define los roles de usuario (administrador, vendedor, etc.)
-- -----------------------------------------------------
CREATE TABLE roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL UNIQUE,
    descripcion TEXT NULL,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    actualizado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Tabla: permisos
-- Define las acciones permitidas en el sistema
-- -----------------------------------------------------
CREATE TABLE permisos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL UNIQUE,
    descripcion TEXT NULL,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    actualizado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Tabla intermedia: rol_permiso
-- Relación muchos a muchos entre roles y permisos
-- -----------------------------------------------------
CREATE TABLE rol_permiso (
    rol_id INT NOT NULL,
    permiso_id INT NOT NULL,
    PRIMARY KEY (rol_id, permiso_id),
    FOREIGN KEY (rol_id) REFERENCES roles(id) ON DELETE CASCADE,
    FOREIGN KEY (permiso_id) REFERENCES permisos(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Tabla: usuario_rol
-- Asigna roles a los usuarios
-- -----------------------------------------------------
CREATE TABLE usuario_rol (
    usuario_id INT NOT NULL,
    rol_id INT NOT NULL,
    PRIMARY KEY (usuario_id, rol_id),
    FOREIGN KEY (usuario_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (rol_id) REFERENCES roles(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Tabla: unidades_medida
-- Normaliza las unidades de medida (kg, gr, und, lt, ml, etc.)
-- -----------------------------------------------------
CREATE TABLE unidades_medida (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(20) NOT NULL UNIQUE,
    abreviatura VARCHAR(10) NULL,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Tabla: categorias_plato
-- Categorías para platos (Entrada, Plato Principal, Postre, etc.)
-- -----------------------------------------------------
CREATE TABLE categorias_plato (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL UNIQUE,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    actualizado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Tabla: categorias_insumo
-- Categorías para insumos (Carnes, Verduras, Lácteos, etc.)
-- -----------------------------------------------------
CREATE TABLE categorias_insumo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL UNIQUE,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    actualizado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Tabla intermedia: producto_categoria
-- Relación muchos a muchos entre productos_insumo y categorias_insumo
-- -----------------------------------------------------
CREATE TABLE producto_categoria (
    insumo_id INT NOT NULL,
    categoria_id INT NOT NULL,
    PRIMARY KEY (insumo_id, categoria_id),
    FOREIGN KEY (insumo_id) REFERENCES productos_insumo(id) ON DELETE CASCADE,
    FOREIGN KEY (categoria_id) REFERENCES categorias_insumo(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Tabla: productos_insumo
-- Insumos utilizados en la cocina (harina, carne, verduras, etc.)
-- -----------------------------------------------------
CREATE TABLE productos_insumo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    descripcion TEXT NULL,
    unidad_medida_id INT NOT NULL,
    precio_compra DECIMAL(10,2) NOT NULL,
    precio_venta DECIMAL(10,2) NULL,
    stock_actual DECIMAL(10,2) NOT NULL DEFAULT 0,
    stock_minimo DECIMAL(10,2) NOT NULL DEFAULT 0,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    actualizado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (unidad_medida_id) REFERENCES unidades_medida(id)
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Tabla: platos
-- Platos finales que se venden al cliente
-- -----------------------------------------------------
CREATE TABLE platos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    descripcion TEXT NULL,
    precio_venta DECIMAL(10,2) NOT NULL,
    categoria_id INT NOT NULL,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    actualizado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (categoria_id) REFERENCES categorias_plato(id) ON DELETE RESTRICT
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Tabla: imagenes_platos
-- Un plato puede tener varias imágenes
-- -----------------------------------------------------
CREATE TABLE imagenes_platos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    plato_id INT NOT NULL,
    imagen_ruta VARCHAR(500) NOT NULL,
    es_principal BOOLEAN NOT NULL DEFAULT FALSE,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (plato_id) REFERENCES platos(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Tabla: menús
-- Menús temáticos (desayunos, brunch, cenas, etc.)
-- -----------------------------------------------------
CREATE TABLE menús (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    descripcion TEXT NULL,
    precio_total DECIMAL(10,2) NOT NULL,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    actualizado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Tabla intermedia: menu_plato
-- Relación muchos a muchos entre menús y platos
-- -----------------------------------------------------
CREATE TABLE menu_plato (
    menu_id INT NOT NULL,
    plato_id INT NOT NULL,
    PRIMARY KEY (menu_id, plato_id),
    FOREIGN KEY (menu_id) REFERENCES menús(id) ON DELETE CASCADE,
    FOREIGN KEY (plato_id) REFERENCES platos(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Tabla: recetas
-- Define cuánto de cada insumo se usa en un plato
-- -----------------------------------------------------
CREATE TABLE recetas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    plato_id INT NOT NULL,
    insumo_id INT NOT NULL,
    cantidad DECIMAL(10,2) NOT NULL,
    unidad VARCHAR(20) NOT NULL,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    actualizado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY unique_insumo_plato (plato_id, insumo_id),
    FOREIGN KEY (plato_id) REFERENCES platos(id) ON DELETE CASCADE,
    FOREIGN KEY (insumo_id) REFERENCES productos_insumo(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Tabla: documentos
-- Tipos de documentos (Boleta de Venta, Guía de Remisión, etc.)
-- -----------------------------------------------------
CREATE TABLE documentos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL UNIQUE,
    prefijo VARCHAR(10) NOT NULL,
    ultimo_numero INT NOT NULL DEFAULT 0,
    estado ENUM('activo', 'inactivo') NOT NULL DEFAULT 'activo',
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    actualizado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Tabla: proveedores
-- Información de los proveedores de insumos
-- -----------------------------------------------------
CREATE TABLE proveedores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    contacto VARCHAR(100) NULL,
    telefono VARCHAR(20) NULL,
    correo VARCHAR(100) NULL,
    direccion TEXT NULL,
    estado ENUM('activo', 'inactivo') NOT NULL DEFAULT 'activo',
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    actualizado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Tabla: clientes
-- Información de los clientes del catering
-- -----------------------------------------------------
CREATE TABLE clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    telefono VARCHAR(20) NULL,
    correo VARCHAR(100) NULL,
    tipo ENUM('habitual', 'ocasional', 'empresa') NOT NULL DEFAULT 'ocasional',
    direccion TEXT NULL,
    observaciones TEXT NULL,
    estado ENUM('activo', 'inactivo') NOT NULL DEFAULT 'activo',
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    actualizado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Tabla: compras
-- Registro de órdenes de compra a proveedores
-- -----------------------------------------------------
CREATE TABLE compras (
    id INT AUTO_INCREMENT PRIMARY KEY,
    proveedor_id INT NOT NULL,
    documento_id INT NOT NULL,
    numero_documento VARCHAR(50) NOT NULL,
    fecha DATE NOT NULL,
    subtotal DECIMAL(12,2) NOT NULL,
    descuento DECIMAL(12,2) NOT NULL DEFAULT 0,
    total DECIMAL(12,2) NOT NULL,
    observaciones TEXT NULL,
    usuario_id INT NOT NULL,
    pdf_ruta VARCHAR(500) NULL,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    actualizado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (proveedor_id) REFERENCES proveedores(id),
    FOREIGN KEY (documento_id) REFERENCES documentos(id),
    FOREIGN KEY (usuario_id) REFERENCES users(id)
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Tabla: detalle_compras
-- Desglose de cada insumo en una compra
-- -----------------------------------------------------
CREATE TABLE detalle_compras (
    id INT AUTO_INCREMENT PRIMARY KEY,
    compra_id INT NOT NULL,
    insumo_id INT NOT NULL,
    cantidad DECIMAL(10,2) NOT NULL,
    precio_unitario DECIMAL(10,2) NOT NULL,
    subtotal DECIMAL(12,2) NOT NULL,
    FOREIGN KEY (compra_id) REFERENCES compras(id) ON DELETE CASCADE,
    FOREIGN KEY (insumo_id) REFERENCES productos_insumo(id)
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Tabla: cotizaciones
-- Presupuestos enviados a clientes
-- -----------------------------------------------------
CREATE TABLE cotizaciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT NOT NULL,
    fecha DATE NOT NULL,
    subtotal DECIMAL(12,2) NOT NULL,
    descuento DECIMAL(12,2) DEFAULT 0,
    total DECIMAL(12,2) NOT NULL,
    estado ENUM('borrador', 'enviado', 'aceptado', 'rechazado') NOT NULL DEFAULT 'borrador',
    observaciones TEXT NULL,
    usuario_id INT NOT NULL,
    pdf_ruta VARCHAR(500) NULL,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    actualizado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (cliente_id) REFERENCES clientes(id),
    FOREIGN KEY (usuario_id) REFERENCES users(id)
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Tabla: detalle_cotizaciones
-- Desglose de platos o menús en una cotización
-- -----------------------------------------------------
CREATE TABLE detalle_cotizaciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cotizacion_id INT NOT NULL,
    plato_id INT NULL,
    menu_id INT NULL,
    cantidad DECIMAL(10,2) NOT NULL,
    precio_unitario DECIMAL(10,2) NOT NULL,
    subtotal DECIMAL(12,2) NOT NULL,
    modificaciones TEXT NULL,
    FOREIGN KEY (cotizacion_id) REFERENCES cotizaciones(id) ON DELETE CASCADE,
    FOREIGN KEY (plato_id) REFERENCES platos(id) ON DELETE SET NULL,
    FOREIGN KEY (menu_id) REFERENCES menús(id) ON DELETE SET NULL,
    CHECK (plato_id IS NOT NULL OR menu_id IS NOT NULL)
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Tabla: ventas
-- Registro de ventas o pedidos a clientes
-- -----------------------------------------------------
CREATE TABLE ventas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT NULL,
    documento_id INT NOT NULL,
    numero_documento VARCHAR(50) NOT NULL,
    fecha DATE NOT NULL,
    subtotal DECIMAL(12,2) NOT NULL,
    descuento DECIMAL(12,2) NOT NULL DEFAULT 0,
    total DECIMAL(12,2) NOT NULL,
    estado ENUM('pendiente', 'completo', 'anulado') NOT NULL DEFAULT 'pendiente',
    observaciones TEXT NULL,
    usuario_id INT NOT NULL,
    pdf_ruta VARCHAR(500) NULL,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    actualizado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (cliente_id) REFERENCES clientes(id),
    FOREIGN KEY (documento_id) REFERENCES documentos(id),
    FOREIGN KEY (usuario_id) REFERENCES users(id)
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Tabla: detalle_ventas
-- Desglose de platos o menús en una venta
-- -----------------------------------------------------
CREATE TABLE detalle_ventas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    venta_id INT NOT NULL,
    plato_id INT NULL,
    menu_id INT NULL,
    cantidad DECIMAL(10,2) NOT NULL,
    precio_unitario DECIMAL(10,2) NOT NULL,
    subtotal DECIMAL(12,2) NOT NULL,
    modificaciones TEXT NULL,
    FOREIGN KEY (venta_id) REFERENCES ventas(id) ON DELETE CASCADE,
    FOREIGN KEY (plato_id) REFERENCES platos(id) ON DELETE SET NULL,
    FOREIGN KEY (menu_id) REFERENCES menús(id) ON DELETE SET NULL,
    CHECK (plato_id IS NOT NULL OR menu_id IS NOT NULL)
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Tabla: pagos
-- Registro de pagos parciales o totales de una venta
-- -----------------------------------------------------
CREATE TABLE pagos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    venta_id INT NOT NULL,
    fecha DATE NOT NULL,
    monto DECIMAL(12,2) NOT NULL,
    metodo ENUM('efectivo', 'transferencia', 'qr', 'otro') NOT NULL,
    referencia VARCHAR(100) NULL,
    observaciones TEXT NULL,
    tipo ENUM('ingreso', 'egreso') NOT NULL DEFAULT 'ingreso',
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (venta_id) REFERENCES ventas(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Tabla: log
-- Auditoría de acciones realizadas por cada usuario
-- -----------------------------------------------------
CREATE TABLE log (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    accion VARCHAR(100) NOT NULL,
    tabla_afectada VARCHAR(50) NOT NULL,
    registro_id INT NULL,
    datos_antiguos TEXT NULL,
    datos_nuevos TEXT NULL,
    ip_address VARCHAR(45) NULL,
    user_agent TEXT NULL,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Índices para mejorar el rendimiento
-- -----------------------------------------------------
CREATE INDEX idx_compras_proveedor ON compras(proveedor_id);
CREATE INDEX idx_ventas_cliente ON ventas(cliente_id);
CREATE INDEX idx_detalle_compras_compra ON detalle_compras(compra_id);
CREATE INDEX idx_detalle_ventas_venta ON detalle_ventas(venta_id);
CREATE INDEX idx_pagos_venta ON pagos(venta_id);
CREATE INDEX idx_log_usuario ON log(usuario_id);
CREATE INDEX idx_log_fecha ON log(creado_en);
CREATE INDEX idx_imagenes_plato ON imagenes_platos(plato_id);
