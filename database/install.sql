
CREATE TABLE papel
(
  id    INT     PRIMARY KEY     AUTO_INCREMENT,
  papel VARCHAR(20) NOT NULL
);

CREATE TABLE papel_usuario
(
  usuario_id INT NOT NULL,
  papel_id   INT NOT NULL,
  PRIMARY KEY (usuario_id, papel_id)
);

CREATE TABLE usuario
(
  id            INT      NULL     AUTO_INCREMENT,
  nome          VARCHAR(20)  NULL    ,
  email         VARCHAR(50)  NOT NULL,
  senha         VARCHAR(20)  NOT NULL,
  data_cadastro DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
);

ALTER TABLE papel_usuario
  ADD CONSTRAINT FK_usuario_TO_papel_usuario
    FOREIGN KEY (usuario_id)
    REFERENCES usuario (id)
    ON DELETE CASCADE;

ALTER TABLE papel_usuario
  ADD CONSTRAINT FK_papel_TO_papel_usuario
    FOREIGN KEY (papel_id)
    REFERENCES papel (id);
