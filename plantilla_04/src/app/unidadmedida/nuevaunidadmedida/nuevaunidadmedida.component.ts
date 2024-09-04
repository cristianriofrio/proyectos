import { Component, OnInit } from '@angular/core';
import { FormControl, FormGroup, FormsModule, ReactiveFormsModule, Validators } from '@angular/forms';
import { IUnidadMedida } from 'src/app/Interfaces/iunidadmedida';
import { UnidadmedidaService } from '../../Services/unidadmedida.service';
import { ActivatedRoute, Router } from '@angular/router';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-nuevaunidadmedida',
  standalone: true,
  imports: [ReactiveFormsModule, FormsModule],
  templateUrl: './nuevaunidadmedida.component.html',
  styleUrl: './nuevaunidadmedida.component.scss'
})
export class NuevaunidadmedidaComponent implements OnInit {
  titulo = 'Nueva Unidad de Medida';
  frm_UnidadMedida = new FormGroup({
    Detalle: new FormControl('', [Validators.required]),
    Tipo: new FormControl('', [Validators.required])
  });
  idUnidadMedida = 0;
  constructor(
    private unidadService: UnidadmedidaService,
    private navegacion: Router,
    private ruta: ActivatedRoute
  ) {}

  ngOnInit(): void {
console.log(this.ruta.snapshot.paramMap)

    this.idUnidadMedida = parseInt(this.ruta.snapshot.paramMap.get('id'));
    console.log(this.idUnidadMedida)
    if (this.idUnidadMedida > 0) {
      this.unidadService.uno(this.idUnidadMedida).subscribe((unidadMedida) => {
        this.frm_UnidadMedida.controls['Detalle'].setValue(unidadMedida.Detalle);
        this.frm_UnidadMedida.controls['Tipo'].setValue(unidadMedida.Tipo.toString());
        console.log(unidadMedida)
      });
      
    }
  }

  grabar() {
    let unidadMedida: IUnidadMedida = {
      idUnidad_Medida: this.idUnidadMedida,
      Detalle: this.frm_UnidadMedida.controls['Detalle'].value,
      Tipo: Number(this.frm_UnidadMedida.controls['Tipo'].value)
    };

    Swal.fire({
      title: 'Unidades de Medida',
      text: 'Desea guardar la Unidad de Medida ' + this.frm_UnidadMedida.controls['Detalle'].value,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#f00',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Grabar!'
    }).then((result) => {
      if (result.isConfirmed) {
        if (this.idUnidadMedida > 0) {
          // Actualizar unidad de medida
          this.unidadService.actualizar(unidadMedida).subscribe((res: any) => {
            Swal.fire({
              title: 'Actualizar Unidades de Medida',
              text: res.mensaje || 'Unidad de Medida actualizada correctamente.',
              icon: 'success'
            });
            this.navegacion.navigate(['/unidadmedida']);
          }, (error) => {
            Swal.fire({
              title: 'Error',
              text: 'Hubo un problema al actualizar la Unidad de Medida',
              icon: 'error'
            });
          });
        } else {
          // Insertar nueva unidad de medida
          this.unidadService.insertar(unidadMedida).subscribe((res: any) => {
            Swal.fire({
              title: 'Nuevo Unidades de Medida',
              text: res.mensaje || 'Unidad de Medida insertada correctamente.',
              icon: 'success'
            });
            this.navegacion.navigate(['/unidadmedida']);
          }, (error) => {
            Swal.fire({
              title: 'Error',
              text: 'Hubo un problema al insertar la Unidad de Medida',
              icon: 'error'
            });
          });
        }
      }
    });
  }

  cambio(objetoSleect: any) {
    this.frm_UnidadMedida.get('Tipo')?.setValue(objetoSleect.target.value);
  }
}
