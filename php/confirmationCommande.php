<?php

session_start();

include("../require/header.php");
$_SESSION["panier"] = [];
?>

<div class="container mt-5 mb-5">
    <div class="row d-flex justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="invoice p-5">
                    <h5>Votre commande est confirmée ! </h5>
                    <span class="font-weight-bold d-block mt-4">
                        Hello, <?= $_SESSION["utilisateur"]["prenom"] ?>
                    </span>
                    <span>Bonne appétit !</span>
                    <div class="payment border-top mt-3 mb-3 border-bottom table-responsive">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="py-2">
                                            <span class="d-block text-muted">Commande</span>
                                            <span><?= $_REQUEST["numeroCommande"] ?></span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="py-2">
                                            <span class="d-block text-muted">Paiement</span>
                                            <span><img src="https://img.icons8.com/color/48/000000/mastercard.png" width="20" /></span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="py-2">
                                            <span class="d-block text-muted">Adresse</span>
                                            <span><?= $_SESSION["utilisateur"]["adresse"] ?></span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>