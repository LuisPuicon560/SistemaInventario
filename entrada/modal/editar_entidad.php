<div class="modal fade" id="edit-entidad" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modificar entidad</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Seleccionar la entidad a registrar -->

                <label for="tipo">Tipo de entidad</label>
                <select name="tipo" id="selectTipo" class="form-control">
                    <option disabled selected>Seleccionar tipo</option>
                    <option value="vendedor">Vendedor</option>
                    <option value="comprador">Comprador</option>
                </select>
                <br>

                <!-- Formulario para tipo de identificación -->
                <div id="Subtipo">
                    <label for="subtipo">Tipo de identificación</label>
                    <select name="subtipo" id="selectSubtipo" class="form-control">
                        <option disabled selected>Seleccionar tipo</option>
                        <option value="natural">Natural</option>
                        <option value="juridico">Ruc</option>
                        <option value="proveedor">Proveedor</option>
                    </select>
                </div>
                <br>
                <!-- Formulario para Proveedor -->
                <div id="formularioProveedor" style="display:none">
                    <h2 class="text-center">Formulario de Proveedor</h2>
                    <form action="../crud/actualizar_entidad.php" id="formulario_proveedor" method="POST">
                        <input type="hidden" name="entidad" class="idEntidad">
                        <input type="hidden" name="persona" class="idPersona">
                        <input type="hidden" value="vendedor" name="tipo_seleccionado" class="tipo_seleccionado">
                        <input type="hidden" value="proveedor" name="subtipo_seleccionado" class="subtipo_seleccionado">
                        <div class="row d-flex justify-content-center">
                            <div class="col-sx-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6 my-2">
                                <label for="n_ruc">Ruc del proveedor:</label>
                                <input type="text" name="n_ruc" class="form-control Ndocumentacion" placeholder="El numero ruc" maxlength="11" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sx-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 my-2">
                                <label for="rsocial">Razon social:</label>
                                <input type="text" name="rsocial" class="form-control Rsocial" placeholder="Escribe el nombre segun la sunat"  readonly>
                            </div>
                            <div class="col-sx-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 my-2">
                                <label for="rcomercial">Nombre Comercial:</label>
                                <input type="text" name="rcomercial" class="form-control Rcomercial" placeholder="Escribe el nombre comercial" >
                            </div>
                        </div>

                        <label for="direccion">Direccion:</label>
                        <input type="text" name="direccion" class="form-control direccion" placeholder="Dirección de la empresa" readonly>
                        <label for="referencia">Referencia:</label>
                        <input type="text" name="referencia" class="form-control referencia" placeholder="Referencia del lugar" >
                        <div class="row">
                            <div class="col-sx-12 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-4 my-2">
                                <label for="distrito">Distrito:</label>
                                <input type="text" name="distrito" class="form-control distrito" placeholder="Distrito de la empresa" readonly>
                            </div>
                            <div class="col-sx-12 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-4 my-2">
                                <label for="provincia">Provincia:</label>
                                <input type="text" name="provincia" class="form-control provincia" placeholder="Provincia de la empresa" readonly>
                            </div>
                            <div class="col-sx-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 col-xxl-4 my-2">
                                <label for="departamento">Departamento:</label>
                                <input type="text" name="departamento" class="form-control departamento" placeholder="Departamento de la empresa" readonly>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-between">
                            <div class="col-sx-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3 my-2">
                                <label for="celular">N° de celular:</label>
                                <input type="text" name="celular" class="form-control celular" placeholder="Numero de celular"  maxlength="9"  >
                            </div>
                            <div class="col-sx-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3 my-2">
                                <label for="telefono">Telefono:</label>
                                <input type="text" name="telefono" class="form-control telefono" placeholder="Numero de telefono"  maxlength="6" >
                            </div>
                            <div class="col-sx-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 my-2">
                                <label for="correo">Correo electronico:</label>
                                <input type="text" name="correo" class="form-control correo" placeholder="Correo de la empresa" >
                            </div>
                        </div>
                        <label for="descripcion">Descripcion de empresa</label>
                        <textarea name="descripcion" cols="20" rows="5" class="form-control descripcion" placeholder="Escriba lo que trata la empresa" ></textarea>
                        <input type="submit" name="proveedor_proveedor" class="btn_proveedor form-control btn btn-dark my-3">

                        
                    </form>
                </div>


                <div id="formularioClienteJuridica" style="display: none;">
                    <h2 class="text-center">Formulario de Cliente Jurídico</h2>
                    <form action="../crud/actualizar_entidad.php" id="formulario_juridico" method="POST">
                        <input type="hidden" name="entidad" class="idEntidad">
                        <input type="hidden" name="persona" class="idPersona">
                        <input type="hidden" value="comprador" name="tipo_seleccionado" class="tipo_seleccionado">
                        <input type="hidden" value="juridica" name="subtipo_seleccionado" class="subtipo_seleccionado">
                        <div class="row d-flex justify-content-center">
                            <div class="col-sx-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6 my-2">
                                <label for="n_ruc">Ruc del cliente juridico:</label>
                                <input type="text" name="n_ruc" class="form-control Ndocumentacion" maxlength="11" placeholder="El numero ruc" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sx-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 my-2">
                                <label for="rsocial">Razon social:</label>
                                <input type="text" name="rsocial" class="form-control Rsocial" placeholder="Escribe el nombre segun la sunat"  readonly>
                            </div>
                            <div class="col-sx-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 my-2">
                                <label for="rcomercial">Nombre Comercial:</label>
                                <input type="text" name="rcomercial" class="form-control Rcomercial" placeholder="Escribe el nombre comercial" >
                            </div>
                        </div>

                        <label for="direccion">Direccion:</label>
                        <input type="text" name="direccion" class="form-control direccion" placeholder="Dirección de la empresa" readonly>
                        <label for="referencia">Referencia:</label>
                        <input type="text" name="referencia" class="form-control referencia" placeholder="Referencia del lugar" >
                        <div class="row">
                            <div class="col-sx-12 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-4">
                                <label for="distrito">Distrito:</label>
                                <input type="text" name="distrito" class="form-control distrito" placeholder="Distrito de la empresa" readonly>
                            </div>
                            <div class="col-sx-12 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-4">
                                <label for="provincia">Provincia:</label>
                                <input type="text" name="provincia" class="form-control provincia" placeholder="Provincia de la empresa" readonly>
                            </div>
                            <div class="col-sx-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 col-xxl-4">
                                <label for="departamento">Departamento:</label>
                                <input type="text" name="departamento" class="form-control departamento" placeholder="Departamento de la empresa" readonly>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-between">
                            <div class="col-sx-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3">
                                <label for="celular">N° de celular:</label>
                                <input type="text" name="celular" class="form-control celular" placeholder="Numero de celular"  maxlength="9"  >
                            </div>
                            <div class="col-sx-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3">
                                <label for="telefono">Telefono:</label>
                                <input type="text" name="telefono" class="form-control telefono" placeholder="Numero de telefono"  maxlength="6" >
                            </div>
                            <div class="col-sx-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                                <label for="correo">Correo electronico:</label>
                                <input type="text" name="correo" class="form-control correo" placeholder="Correo de la empresa" >
                            </div>
                        </div>
                        <label for="descripcion">Descripcion de empresa</label>
                        <textarea name="descripcion" cols="20" rows="5" class="form-control descripcion" placeholder="Escriba lo que trata la empresa" ></textarea>
                        <input type="submit" name="cliente_juridico" class="btn_juridico form-control btn btn-dark my-3">
                        <br>
                    </form>
                </div>

                <!-- Formulario de edcion a cliente natural  -->
                <div id="formularioClienteNatural" style="display: none;">
                    <h2 class="text-center">Formulario de Cliente Natural</h2>
                    <form action="../crud/actualizar_entidad.php" id="formulario_natural" method="POST">
                        <input type="hidden" name="entidad" class="idEntidad">
                        <input type="hidden" name="persona" class="idPersona">
                        <input type="hidden" value="comprador" name="tipo_seleccionado" class="tipo_seleccionado">
                        <input type="hidden" value="natural" name="subtipo_seleccionado" class="subtipo_seleccionado">
                        <div class="row">
                            <div class="col-sx-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3">
                                <label for="dni">Dni:</label>
                                <input type="text" name="dni" class="form-control Ndocumentacion" maxlength="8">
                            </div>
                            <div class="col-sx-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3">
                                <label for="celular">Celular:</label>
                                <input type="text" name="celular" class="form-control celular"  maxlength="9">
                            </div>
                            <div class="col-sx-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                                <label for="correo">Correo electronico:</label>
                                <input type="text" name="correo" class="form-control correo" >
                            </div>

                        </div>
                        <label for="nombres" class="my-1">Nombres de la entidad:</label>
                        <input type="text" name="nombres" class="form-control nombres" readonly>
                        <label for="represent_tres" class="my-1">Primer apellido de entidad:</label>
                        <input type="text" name="represent_tres" class="form-control Represent_tres" readonly>
                        <label for="represent_cuatro" class="my-1">Segundo apellido de entidad:</label>
                        <input type="text" name="represent_cuatro" class="form-control Represent_cuatro" readonly>
                        <label for="departamento" class="my-1">Departamento registrado:</label>
                        <input type="text" name="departamento" class="form-control departamento ">
                        <input type="submit" name="cliente_natural" class="btn_natural form-control btn btn-dark my-3" >

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // Evitar el envío del formulario al presionar "Enter"
    document.querySelector("#edit-entidad form").addEventListener("keydown", function(e) {
        if (e.key === "Enter") {
            e.preventDefault();
            return false;
        }
    });
</script>