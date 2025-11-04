-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         SQL Server 2019
-- SO del servidor:              Windows
-- --------------------------------------------------------

-- Volcando estructura para tabla examen_grado.cache
CREATE TABLE cache (
  [key] varchar(255) NOT NULL,
  [value] varchar(MAX) NOT NULL,
  expiration int NOT NULL,
  PRIMARY KEY ([key])
);

-- Volcando estructura para tabla examen_grado.cache_locks
CREATE TABLE cache_locks (
  [key] varchar(255) NOT NULL,
  owner varchar(255) NOT NULL,
  expiration int NOT NULL,
  PRIMARY KEY ([key])
);

-- Volcando estructura para tabla examen_grado.categorias_insumo
CREATE TABLE categorias_insumo (
  id bigint IDENTITY(1,1) NOT NULL,
  nombre varchar(100) NOT NULL,
  created_at datetime NULL,
  updated_at datetime NULL,
  PRIMARY KEY (id),
  CONSTRAINT categorias_insumo_nombre_unique UNIQUE (nombre)
);

-- Volcando estructura para tabla examen_grado.categorias_plato
CREATE TABLE categorias_plato (
  id bigint IDENTITY(1,1) NOT NULL,
  nombre varchar(100) NOT NULL,
  created_at datetime NULL,
  updated_at datetime NULL,
  PRIMARY KEY (id),
  CONSTRAINT categorias_plato_nombre_unique UNIQUE (nombre)
);

-- Volcando estructura para tabla examen_grado.clientes
CREATE TABLE clientes (
  id bigint IDENTITY(1,1) NOT NULL,
  nombre varchar(255) NOT NULL,
  telefono varchar(20) NULL,
  correo varchar(100) NULL,
  tipo varchar(10) NOT NULL DEFAULT 'ocasional' CHECK (tipo IN ('habitual','ocasional','empresa')),
  direccion text NULL,
  observaciones text NULL,
  estado varchar(8) NOT NULL DEFAULT 'activo' CHECK (estado IN ('activo','inactivo')),
  created_at datetime NULL,
  updated_at datetime NULL,
  PRIMARY KEY (id)
);

-- Volcando estructura para tabla examen_grado.compras
CREATE TABLE compras (
  id bigint IDENTITY(1,1) NOT NULL,
  proveedor_id bigint NOT NULL,
  documento_id bigint NOT NULL,
  numero_documento varchar(50) NOT NULL,
  fecha date NOT NULL,
  subtotal decimal(12,2) NOT NULL,
  descuento decimal(12,2) NOT NULL DEFAULT 0.00,
  total decimal(12,2) NOT NULL,
  observaciones text NULL,
  usuario_id bigint NOT NULL,
  pdf_ruta varchar(500) NULL,
  created_at datetime NULL,
  updated_at datetime NULL,
  PRIMARY KEY (id),
  CONSTRAINT compras_proveedor_id_foreign FOREIGN KEY (proveedor_id) REFERENCES proveedores (id),
  CONSTRAINT compras_documento_id_foreign FOREIGN KEY (documento_id) REFERENCES documentos (id),
  CONSTRAINT compras_usuario_id_foreign FOREIGN KEY (usuario_id) REFERENCES users (id)
);

CREATE INDEX compras_proveedor_id_foreign ON compras (proveedor_id);
CREATE INDEX compras_documento_id_foreign ON compras (documento_id);
CREATE INDEX compras_usuario_id_foreign ON compras (usuario_id);

-- Volcando estructura para tabla examen_grado.cotizaciones
CREATE TABLE cotizaciones (
  id bigint IDENTITY(1,1) NOT NULL,
  cliente_id bigint NOT NULL,
  fecha date NOT NULL,
  subtotal decimal(12,2) NOT NULL,
  descuento decimal(12,2) NOT NULL DEFAULT 0.00,
  total decimal(12,2) NOT NULL,
  estado varchar(10) NOT NULL DEFAULT 'borrador' CHECK (estado IN ('borrador','enviado','aceptado','rechazado')),
  observaciones text NULL,
  usuario_id bigint NOT NULL,
  pdf_ruta varchar(500) NULL,
  created_at datetime NULL,
  updated_at datetime NULL,
  PRIMARY KEY (id),
  CONSTRAINT cotizaciones_cliente_id_foreign FOREIGN KEY (cliente_id) REFERENCES clientes (id),
  CONSTRAINT cotizaciones_usuario_id_foreign FOREIGN KEY (usuario_id) REFERENCES users (id)
);

CREATE INDEX cotizaciones_cliente_id_foreign ON cotizaciones (cliente_id);
CREATE INDEX cotizaciones_usuario_id_foreign ON cotizaciones (usuario_id);

-- Volcando estructura para tabla examen_grado.detalle_compras
CREATE TABLE detalle_compras (
  id bigint IDENTITY(1,1) NOT NULL,
  compra_id bigint NOT NULL,
  insumo_id bigint NOT NULL,
  cantidad decimal(10,2) NOT NULL,
  precio_unitario decimal(10,2) NOT NULL,
  subtotal decimal(12,2) NOT NULL,
  created_at datetime NULL,
  updated_at datetime NULL,
  PRIMARY KEY (id),
  CONSTRAINT detalle_compras_compra_id_foreign FOREIGN KEY (compra_id) REFERENCES compras (id) ON DELETE CASCADE,
  CONSTRAINT detalle_compras_insumo_id_foreign FOREIGN KEY (insumo_id) REFERENCES productos_insumo (id)
);

CREATE INDEX detalle_compras_compra_id_foreign ON detalle_compras (compra_id);
CREATE INDEX detalle_compras_insumo_id_foreign ON detalle_compras (insumo_id);

-- Volcando estructura para tabla examen_grado.detalle_cotizaciones
CREATE TABLE detalle_cotizaciones (
  id bigint IDENTITY(1,1) NOT NULL,
  cotizacion_id bigint NOT NULL,
  plato_id bigint NULL,
  menu_id bigint NULL,
  cantidad decimal(10,2) NOT NULL,
  precio_unitario decimal(10,2) NOT NULL,
  subtotal decimal(12,2) NOT NULL,
  modificaciones text NULL,
  created_at datetime NULL,
  updated_at datetime NULL,
  PRIMARY KEY (id),
  CONSTRAINT detalle_cotizaciones_cotizacion_id_foreign FOREIGN KEY (cotizacion_id) REFERENCES cotizaciones (id) ON DELETE CASCADE,
  CONSTRAINT detalle_cotizaciones_plato_id_foreign FOREIGN KEY (plato_id) REFERENCES platos (id) ON DELETE SET NULL,
  CONSTRAINT detalle_cotizaciones_menu_id_foreign FOREIGN KEY (menu_id) REFERENCES menús (id) ON DELETE SET NULL
);

CREATE INDEX detalle_cotizaciones_cotizacion_id_foreign ON detalle_cotizaciones (cotizacion_id);
CREATE INDEX detalle_cotizaciones_plato_id_foreign ON detalle_cotizaciones (plato_id);
CREATE INDEX detalle_cotizaciones_menu_id_foreign ON detalle_cotizaciones (menu_id);

-- Volcando estructura para tabla examen_grado.detalle_ventas
CREATE TABLE detalle_ventas (
  id bigint IDENTITY(1,1) NOT NULL,
  venta_id bigint NOT NULL,
  plato_id bigint NULL,
  menu_id bigint NULL,
  cantidad decimal(10,2) NOT NULL,
  precio_unitario decimal(10,2) NOT NULL,
  subtotal decimal(12,2) NOT NULL,
  modificaciones text NULL,
  created_at datetime NULL,
  updated_at datetime NULL,
  PRIMARY KEY (id),
  CONSTRAINT detalle_ventas_venta_id_foreign FOREIGN KEY (venta_id) REFERENCES ventas (id) ON DELETE CASCADE,
  CONSTRAINT detalle_ventas_plato_id_foreign FOREIGN KEY (plato_id) REFERENCES platos (id) ON DELETE SET NULL,
  CONSTRAINT detalle_ventas_menu_id_foreign FOREIGN KEY (menu_id) REFERENCES menús (id) ON DELETE SET NULL
);

CREATE INDEX detalle_ventas_venta_id_foreign ON detalle_ventas (venta_id);
CREATE INDEX detalle_ventas_plato_id_foreign ON detalle_ventas (plato_id);
CREATE INDEX detalle_ventas_menu_id_foreign ON detalle_ventas (menu_id);

-- Volcando estructura para tabla examen_grado.documentos
CREATE TABLE documentos (
  id bigint IDENTITY(1,1) NOT NULL,
  nombre varchar(100) NOT NULL,
  prefijo varchar(10) NOT NULL,
  ultimo_numero int NOT NULL DEFAULT 0,
  estado varchar(8) NOT NULL DEFAULT 'activo' CHECK (estado IN ('activo','inactivo')),
  created_at datetime NULL,
  updated_at datetime NULL,
  PRIMARY KEY (id),
  CONSTRAINT documentos_nombre_unique UNIQUE (nombre)
);

-- Volcando estructura para tabla examen_grado.failed_jobs
CREATE TABLE failed_jobs (
  id bigint IDENTITY(1,1) NOT NULL,
  uuid varchar(255) NOT NULL,
  connection text NOT NULL,
  queue text NOT NULL,
  payload varchar(MAX) NOT NULL,
  exception varchar(MAX) NOT NULL,
  failed_at datetime NOT NULL DEFAULT GETDATE(),
  PRIMARY KEY (id),
  CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid)
);

-- Volcando estructura para tabla examen_grado.imagenes_platos
CREATE TABLE imagenes_platos (
  id bigint IDENTITY(1,1) NOT NULL,
  plato_id bigint NOT NULL,
  imagen_ruta varchar(500) NOT NULL,
  es_principal bit NOT NULL DEFAULT 0,
  created_at datetime NULL,
  updated_at datetime NULL,
  PRIMARY KEY (id),
  CONSTRAINT imagenes_platos_plato_id_foreign FOREIGN KEY (plato_id) REFERENCES platos (id) ON DELETE CASCADE
);

CREATE INDEX imagenes_platos_plato_id_foreign ON imagenes_platos (plato_id);

-- Volcando estructura para tabla examen_grado.jobs
CREATE TABLE jobs (
  id bigint IDENTITY(1,1) NOT NULL,
  queue varchar(255) NOT NULL,
  payload varchar(MAX) NOT NULL,
  attempts tinyint NOT NULL,
  reserved_at int NULL,
  available_at int NOT NULL,
  created_at int NOT NULL,
  PRIMARY KEY (id)
);

CREATE INDEX jobs_queue_index ON jobs (queue);

-- Volcando estructura para tabla examen_grado.job_batches
CREATE TABLE job_batches (
  id varchar(255) NOT NULL,
  name varchar(255) NOT NULL,
  total_jobs int NOT NULL,
  pending_jobs int NOT NULL,
  failed_jobs int NOT NULL,
  failed_job_ids varchar(MAX) NOT NULL,
  options varchar(MAX) NULL,
  cancelled_at int NULL,
  created_at int NOT NULL,
  finished_at int NULL,
  PRIMARY KEY (id)
);

-- Volcando estructura para tabla examen_grado.log
CREATE TABLE log (
  id bigint IDENTITY(1,1) NOT NULL,
  usuario_id bigint NOT NULL,
  accion varchar(100) NOT NULL,
  tabla_afectada varchar(50) NOT NULL,
  registro_id bigint NULL,
  datos_antiguos text NULL,
  datos_nuevos text NULL,
  ip_address varchar(45) NULL,
  user_agent text NULL,
  created_at datetime NULL,
  updated_at datetime NULL,
  PRIMARY KEY (id),
  CONSTRAINT log_usuario_id_foreign FOREIGN KEY (usuario_id) REFERENCES users (id) ON DELETE CASCADE
);

CREATE INDEX log_usuario_id_foreign ON log (usuario_id);

-- Volcando estructura para tabla examen_grado.menu_plato
CREATE TABLE menu_plato (
  menu_id bigint NOT NULL,
  plato_id bigint NOT NULL,
  PRIMARY KEY (menu_id, plato_id),
  CONSTRAINT menu_plato_menu_id_foreign FOREIGN KEY (menu_id) REFERENCES menús (id) ON DELETE CASCADE,
  CONSTRAINT menu_plato_plato_id_foreign FOREIGN KEY (plato_id) REFERENCES platos (id) ON DELETE CASCADE
);

CREATE INDEX menu_plato_plato_id_foreign ON menu_plato (plato_id);

-- Volcando estructura para tabla examen_grado.menús
CREATE TABLE menús (
  id bigint IDENTITY(1,1) NOT NULL,
  nombre varchar(255) NOT NULL,
  descripcion text NULL,
  precio_total decimal(10,2) NOT NULL,
  created_at datetime NULL,
  updated_at datetime NULL,
  PRIMARY KEY (id)
);

-- Volcando estructura para tabla examen_grado.migrations
CREATE TABLE migrations (
  id int IDENTITY(1,1) NOT NULL,
  migration varchar(255) NOT NULL,
  batch int NOT NULL,
  PRIMARY KEY (id)
);

-- Volcando estructura para tabla examen_grado.pagos
CREATE TABLE pagos (
  id bigint IDENTITY(1,1) NOT NULL,
  venta_id bigint NOT NULL,
  fecha date NOT NULL,
  monto decimal(12,2) NOT NULL,
  metodo varchar(15) NOT NULL CHECK (metodo IN ('efectivo','transferencia','qr','otro')),
  referencia varchar(100) NULL,
  observaciones text NULL,
  tipo varchar(7) NOT NULL DEFAULT 'ingreso' CHECK (tipo IN ('ingreso','egreso')),
  created_at datetime NULL,
  updated_at datetime NULL,
  PRIMARY KEY (id),
  CONSTRAINT pagos_venta_id_foreign FOREIGN KEY (venta_id) REFERENCES ventas (id) ON DELETE CASCADE
);

CREATE INDEX pagos_venta_id_foreign ON pagos (venta_id);

-- Volcando estructura para tabla examen_grado.password_reset_tokens
CREATE TABLE password_reset_tokens (
  email varchar(255) NOT NULL,
  token varchar(255) NOT NULL,
  created_at datetime NULL,
  PRIMARY KEY (email)
);

-- Volcando estructura para tabla examen_grado.permisos
CREATE TABLE permisos (
  id bigint IDENTITY(1,1) NOT NULL,
  nombre varchar(100) NOT NULL,
  descripcion text NULL,
  created_at datetime NULL,
  updated_at datetime NULL,
  PRIMARY KEY (id),
  CONSTRAINT permisos_nombre_unique UNIQUE (nombre)
);

-- Volcando estructura para tabla examen_grado.platos
CREATE TABLE platos (
  id bigint IDENTITY(1,1) NOT NULL,
  nombre varchar(255) NOT NULL,
  descripcion text NULL,
  precio_venta decimal(10,2) NOT NULL,
  categoria_id bigint NOT NULL,
  created_at datetime NULL,
  updated_at datetime NULL,
  PRIMARY KEY (id),
  CONSTRAINT platos_categoria_id_foreign FOREIGN KEY (categoria_id) REFERENCES categorias_plato (id)
);

CREATE INDEX platos_categoria_id_foreign ON platos (categoria_id);

-- Volcando estructura para tabla examen_grado.productos_insumo
CREATE TABLE productos_insumo (
  id bigint IDENTITY(1,1) NOT NULL,
  nombre varchar(255) NOT NULL,
  descripcion text NULL,
  unidad_medida_id bigint NOT NULL,
  precio_compra decimal(10,2) NOT NULL,
  precio_venta decimal(10,2) NULL,
  stock_actual decimal(10,2) NOT NULL DEFAULT 0.00,
  stock_minimo decimal(10,2) NOT NULL DEFAULT 0.00,
  created_at datetime NULL,
  updated_at datetime NULL,
  PRIMARY KEY (id),
  CONSTRAINT productos_insumo_unidad_medida_id_foreign FOREIGN KEY (unidad_medida_id) REFERENCES unidades_medida (id)
);

CREATE INDEX productos_insumo_unidad_medida_id_foreign ON productos_insumo (unidad_medida_id);

-- Volcando estructura para tabla examen_grado.producto_categoria
CREATE TABLE producto_categoria (
  insumo_id bigint NOT NULL,
  categoria_id bigint NOT NULL,
  PRIMARY KEY (insumo_id, categoria_id),
  CONSTRAINT producto_categoria_categoria_id_foreign FOREIGN KEY (categoria_id) REFERENCES categorias_insumo (id) ON DELETE CASCADE,
  CONSTRAINT producto_categoria_insumo_id_foreign FOREIGN KEY (insumo_id) REFERENCES productos_insumo (id) ON DELETE CASCADE
);

CREATE INDEX producto_categoria_categoria_id_foreign ON producto_categoria (categoria_id);

-- Volcando estructura para tabla examen_grado.proveedores
CREATE TABLE proveedores (
  id bigint IDENTITY(1,1) NOT NULL,
  nombre varchar(255) NOT NULL,
  contacto varchar(100) NULL,
  telefono varchar(20) NULL,
  correo varchar(100) NULL,
  direccion text NULL,
  estado varchar(8) NOT NULL DEFAULT 'activo' CHECK (estado IN ('activo','inactivo')),
  created_at datetime NULL,
  updated_at datetime NULL,
  PRIMARY KEY (id)
);

-- Volcando estructura para tabla examen_grado.recetas
CREATE TABLE recetas (
  id bigint IDENTITY(1,1) NOT NULL,
  plato_id bigint NOT NULL,
  insumo_id bigint NOT NULL,
  cantidad decimal(10,2) NOT NULL,
  unidad varchar(20) NOT NULL,
  created_at datetime NULL,
  updated_at datetime NULL,
  PRIMARY KEY (id),
  CONSTRAINT recetas_plato_id_insumo_id_unique UNIQUE (plato_id, insumo_id),
  CONSTRAINT recetas_insumo_id_foreign FOREIGN KEY (insumo_id) REFERENCES productos_insumo (id) ON DELETE CASCADE,
  CONSTRAINT recetas_plato_id_foreign FOREIGN KEY (plato_id) REFERENCES platos (id) ON DELETE CASCADE
);

CREATE INDEX recetas_insumo_id_foreign ON recetas (insumo_id);

-- Volcando estructura para tabla examen_grado.roles
CREATE TABLE roles (
  id bigint IDENTITY(1,1) NOT NULL,
  nombre varchar(50) NOT NULL,
  descripcion text NULL,
  created_at datetime NULL,
  updated_at datetime NULL,
  PRIMARY KEY (id),
  CONSTRAINT roles_nombre_unique UNIQUE (nombre)
);

-- Volcando estructura para tabla examen_grado.rol_permiso
CREATE TABLE rol_permiso (
  rol_id bigint NOT NULL,
  permiso_id bigint NOT NULL,
  PRIMARY KEY (rol_id, permiso_id),
  CONSTRAINT rol_permiso_permiso_id_foreign FOREIGN KEY (permiso_id) REFERENCES permisos (id) ON DELETE CASCADE,
  CONSTRAINT rol_permiso_rol_id_foreign FOREIGN KEY (rol_id) REFERENCES roles (id) ON DELETE CASCADE
);

CREATE INDEX rol_permiso_permiso_id_foreign ON rol_permiso (permiso_id);

-- Volcando estructura para tabla examen_grado.sessions
CREATE TABLE sessions (
  id varchar(255) NOT NULL,
  user_id bigint NULL,
  ip_address varchar(45) NULL,
  user_agent text NULL,
  payload varchar(MAX) NOT NULL,
  last_activity int NOT NULL,
  PRIMARY KEY (id)
);

CREATE INDEX sessions_user_id_index ON sessions (user_id);
CREATE INDEX sessions_last_activity_index ON sessions (last_activity);

-- Volcando estructura para tabla examen_grado.unidades_medida
CREATE TABLE unidades_medida (
  id bigint IDENTITY(1,1) NOT NULL,
  nombre varchar(20) NOT NULL,
  abreviatura varchar(10) NULL,
  created_at datetime NULL,
  updated_at datetime NULL,
  PRIMARY KEY (id),
  CONSTRAINT unidades_medida_nombre_unique UNIQUE (nombre)
);

-- Volcando estructura para tabla examen_grado.users
CREATE TABLE users (
  id bigint IDENTITY(1,1) NOT NULL,
  name varchar(255) NOT NULL,
  email varchar(255) NOT NULL,
  email_verified_at datetime NULL,
  password varchar(255) NOT NULL,
  remember_token varchar(100) NULL,
  created_at datetime NULL,
  updated_at datetime NULL,
  PRIMARY KEY (id),
  CONSTRAINT users_email_unique UNIQUE (email)
);

-- Volcando estructura para tabla examen_grado.usuario_rol
CREATE TABLE usuario_rol (
  usuario_id bigint NOT NULL,
  rol_id bigint NOT NULL,
  PRIMARY KEY (usuario_id, rol_id),
  CONSTRAINT usuario_rol_rol_id_foreign FOREIGN KEY (rol_id) REFERENCES roles (id) ON DELETE CASCADE,
  CONSTRAINT usuario_rol_usuario_id_foreign FOREIGN KEY (usuario_id) REFERENCES users (id) ON DELETE CASCADE
);

CREATE INDEX usuario_rol_rol_id_foreign ON usuario_rol (rol_id);

-- Volcando estructura para tabla examen_grado.ventas
CREATE TABLE ventas (
  id bigint IDENTITY(1,1) NOT NULL,
  cliente_id bigint NULL,
  documento_id bigint NOT NULL,
  numero_documento varchar(50) NOT NULL,
  fecha date NOT NULL,
  subtotal decimal(12,2) NOT NULL,
  descuento decimal(12,2) NOT NULL DEFAULT 0.00,
  total decimal(12,2) NOT NULL,
  estado varchar(9) NOT NULL DEFAULT 'pendiente' CHECK (estado IN ('pendiente','completo','anulado')),
  observaciones text NULL,
  usuario_id bigint NOT NULL,
  pdf_ruta varchar(500) NULL,
  created_at datetime NULL,
  updated_at datetime NULL,
  PRIMARY KEY (id),
  CONSTRAINT ventas_cliente_id_foreign FOREIGN KEY (cliente_id) REFERENCES clientes (id),
  CONSTRAINT ventas_documento_id_foreign FOREIGN KEY (documento_id) REFERENCES documentos (id),
  CONSTRAINT ventas_usuario_id_foreign FOREIGN KEY (usuario_id) REFERENCES users (id)
);

CREATE INDEX ventas_cliente_id_foreign ON ventas (cliente_id);
CREATE INDEX ventas_documento_id_foreign ON ventas (documento_id);
CREATE INDEX ventas_usuario_id_foreign ON ventas (usuario_id);