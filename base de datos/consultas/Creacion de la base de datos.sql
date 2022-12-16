use master
go

create database Argosal
on
(
name=Argosal_dat,
filename='E:\bases de datos\Argosal\Argosal.mdf',
size=10,
filegrowth=5
)
log on 
(
name=Argosal_log,
filename='E:\bases de datos\Argosal\Argosal.ldf',
size=5mb,
filegrowth=5mb
)
go