CREATE TABLE Estudiantes (
    estudiante_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    fecha_nacimiento DATE NOT NULL,
    grado VARCHAR(10) NOT NULL
);

CREATE TABLE Profesores (
    profesor_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    especialidad VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL
);

CREATE TABLE Clases (
    clase_id INT AUTO_INCREMENT PRIMARY KEY,
    profesor_id INT,
    nombre_clase VARCHAR(100) NOT NULL,
    horario VARCHAR(50) NOT NULL,
    FOREIGN KEY (profesor_id) REFERENCES Profesores(profesor_id)
);

CREATE TABLE Asignaciones (
    asignacion_id INT AUTO_INCREMENT PRIMARY KEY,
    estudiante_id INT,
    clase_id INT,
    FOREIGN KEY (estudiante_id) REFERENCES Estudiantes(estudiante_id),
    FOREIGN KEY (clase_id) REFERENCES Clases(clase_id)
);
