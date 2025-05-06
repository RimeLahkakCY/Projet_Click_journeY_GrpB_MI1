{\rtf1\ansi\ansicpg1252\cocoartf2821
\cocoatextscaling0\cocoaplatform0{\fonttbl\f0\fswiss\fcharset0 Helvetica;}
{\colortbl;\red255\green255\blue255;}
{\*\expandedcolortbl;;}
\paperw11900\paperh16840\margl1440\margr1440\vieww11520\viewh8400\viewkind0
\pard\tx720\tx1440\tx2160\tx2880\tx3600\tx4320\tx5040\tx5760\tx6480\tx7200\tx7920\tx8640\pardirnatural\partightenfactor0

\f0\fs24 \cf0 <!-- Apr\'e8s les d\'e9tails du voyage -->\
<div class="card mt-4">\
    <div class="card-header">\
        <h4>Personnaliser votre voyage</h4>\
    </div>\
    <div class="card-body">\
        <form action="index.php?page=add_to_cart" method="post">\
            <input type="hidden" name="trip_id" value="<?php echo $trip['id']; ?>">\
            \
            <!-- Options du voyage -->\
            <div class="form-group">\
                <label for="departure_date">Date de d\'e9part</label>\
                <input type="date" class="form-control" id="departure_date" name="options[departure_date]" required>\
            </div>\
            \
            <div class="form-group">\
                <label for="travelers">Nombre de voyageurs</label>\
                <select class="form-control" id="travelers" name="options[travelers]">\
                    <?php for ($i = 1; $i <= 10; $i++): ?>\
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>\
                    <?php endfor; ?>\
                </select>\
            </div>\
            \
            <div class="form-group">\
                <label>Options suppl\'e9mentaires</label>\
                <div class="form-check">\
                    <input class="form-check-input" type="checkbox" id="insurance" name="options[insurance]" value="1">\
                    <label class="form-check-label" for="insurance">\
                        Assurance voyage (+50\'80)\
                    </label>\
                </div>\
                <div class="form-check">\
                    <input class="form-check-input" type="checkbox" id="guide" name="options[guide]" value="1">\
                    <label class="form-check-label" for="guide">\
                        Guide priv\'e9 (+100\'80)\
                    </label>\
                </div>\
                <div class="form-check">\
                    <input class="form-check-input" type="checkbox" id="premium" name="options[premium]" value="1">\
                    <label class="form-check-label" for="premium">\
                        H\'e9bergement premium (+200\'80)\
                    </label>\
                </div>\
            </div>\
            \
            <button type="submit" class="btn btn-primary">Ajouter au panier</button>\
        </form>\
    </div>\
</div>}