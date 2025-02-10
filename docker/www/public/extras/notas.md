Para poder eliminar usuarios en el panel de administrador, identificando su id_usuario y su id_rol 
-- Eliminar la restricción existente
ALTER TABLE usuarios DROP FOREIGN KEY fk_usuarios_roles;

-- Volver a crear con ON DELETE CASCADE
ALTER TABLE usuarios
ADD CONSTRAINT fk_usuarios_roles
FOREIGN KEY (id_rol) 
REFERENCES roles(id_rol)
ON DELETE CASCADE;