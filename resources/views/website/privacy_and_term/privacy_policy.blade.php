@extends('website.app')
@section('contents')
    <style>
        .container_pivacy {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .policy-section {
            /* border: 1px solid #dee2e6; */
            border-radius: 8px;
            padding: 22px 32px
                /* background-color: #f8f9fa; */
                /* margin-bottom: 20px; */
        }

        .policy-title {
            font-size: 22px;
            font-weight: bold;
            color: #1077B8;
            margin-bottom: 14px;
        }

        .policy-content {
            font-size: 18px;
            color: #333;
            line-height: 1.6;
            margin-bottom: 0;
        }

        .see-more {
            color: #1077B8;
            font-weight: bold;
            cursor: pointer;
            font-size: 14px;
        }

        .privacy-heading {
            text-align: center;
            margin-top: 20px;
            font-size: 27px;
            color: #1077B8;
            font-weight: bold;
        }
    </style>

    <div class="container_pivacy d-flex justify-content-center">
        <div class="col-10">
            <div class="row d-flex justify-content-center ">
                <h2 class="privacy-heading mb-4">Privacy Policy</h2>
                <div class="card border-0 shadow mb-5">
                    {{-- <div class="policy-section">
                        <h3 class="policy-title">Privacy</h3>
                        <p class="policy-content">
                            Ask CDCR San Quintin State Prison 2008. We installed Purex dispensers throughout the prison to
                            combat diseases…and it was a Roaring Success (as in Roaring Drunk) I mean we had Long lines of
                            prisoners fist fighting to use them.Ask CDCR San Quintin State Prison 2008. We installed Purex
                            dispensers throughout the prison to combat diseases…and it was a Roaring Success (as in Roaring
                            Drunk) I mean we had Long lines of prisoners fist fighting to use them.Ask CDCR San Quintin
                            State Prison 2008.
                            <span class="see-more" aria-label="See more about Privacy">See more</span>
                        </p>
                    </div> --}}

                    {!! $policy !!}
                </div>
            </div>
        </div>
    </div>
@endsection
