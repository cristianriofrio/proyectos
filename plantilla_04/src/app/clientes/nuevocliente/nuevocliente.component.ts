import { Component } from '@angular/core';
import { FormControl, FormGroupName, ReactiveFormsModule, Validators } from '@angular/forms';
import { ICliente} from 'scr/app/Interfaces/icliente';
import { ClientesService } from 'src/app/Services/clientes.service';

@Component({
  selector: 'app-nuevocliente',
  standalone: true,
  imports: [ReactiveFormsModule],
  templateUrl: './nuevocliente.component.html',
  styleUrl: './nuevocliente.component.scss'
})
export class NuevoclienteComponent {
fromGroup = new FormGroup({
  idClientes: new FormControl(),
  Nombres: new FormControl('',Validators.required),
  Direccion: new FormControl('',Validators.required),
  Telefono: new FormControl('',Validators.required),
  Cedula: new FormControl('',[Validators.required, Validators.minLength{10}]),
  Correo: new FormControl('',[Validators.required, Validators.email]),
});
idClientes = 0;
constructor(private clienteServicio: ClientesService) {}

grabar() {
  let cliente: ICliente
}



}
