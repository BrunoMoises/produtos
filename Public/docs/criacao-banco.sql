CREATE TABLE `produto` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `descricao` VARCHAR(255) NOT NULL,
    `valorVenda` DECIMAL(10,2) NOT NULL,
    `estoque` INT NOT NULL
);

CREATE TABLE `pedido` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `valor` DECIMAL(10,2) NOT NULL
);

CREATE TABLE `pedido_item` (
    `pedido_id` INT NOT NULL,
    `produto_id` INT NOT NULL,
    `quantidade` INT NOT NULL, 
    PRIMARY KEY (`pedido_id`, `produto_id`)
);

CREATE TABLE `imagens` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `produto_id` INT NOT NULL ,
    `imagem` BLOB NOT NULL
);

ALTER TABLE `pedido_item` ADD CONSTRAINT `FK_PEDIDO#PEDIDO_ITEM` FOREIGN KEY (`pedido_id`) 
REFERENCES pedido(`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `pedido_item` ADD CONSTRAINT `FK_PRODUTO#PEDIDO_ITEM` FOREIGN KEY (`produto_id`) 
REFERENCES produto(`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `imagens` ADD CONSTRAINT `FK_PRODUTO#IMAGENS` FOREIGN KEY (`produto_id`) 
REFERENCES produto(`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;