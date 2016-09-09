# whois-api

A webservice using Slim Framework to search for domain name availability and WHOIS information.

## How it works

This service fetches data using Whois (RFC954) library for PHP and retuns the results for regrinfo.
The response is an json containing, at least, an object 'regrinfo', containing the output from the whois lookup.

It fully supports IDNA (internationalized) domains names as defined in RFC3490, RFC3491, RFC3492 and RFC3454.


## Running the service

    This serive is dockerized and you can simply run it after building the image.

## Usage

### healthcheck

    curl "http://localhost/"

### analyze

    curl "http://localhost/lookup?url=:url"

* `:url` url of the page you want to inspect. (e.g. `google.com`)
* `:deep` this is an optional parameter. If you just want to know if a domain is registered or not but do not care about getting the real owner information you can set:
deep=false
* `:server` and `tld` allow you to use a different whois server than the preconfigured or discovered one and must be used in conjuction
The response is an json object containing the output from the whois lookup.

```json
[
  {
    "regrinfo":
      {"domain":
        {"name":"cnn.com","nserver":
          {"ns1.p42.dynect.net":"208.78.70.42",
          "ns1.timewarner.net":"204.74.108.238",
          "ns2.p42.dynect.net":"204.13.250.42",
          "ns3.timewarner.net":"199.7.68.238"
          },
          "status":
            ["clientTransferProhibited https:\/\/icann.org\/epp#clientTransferProhibited",
            "serverDeleteProhibited https:\/\/icann.org\/epp#serverDeleteProhibited",
            "serverTransferProhibited https:\/\/icann.org\/epp#serverTransferProhibited",
            "serverUpdateProhibited https:\/\/icann.org\/epp#serverUpdateProhibited"
            ],
          "changed":"2013-08-29",
          "created":"1993-09-22",
          "expires":"2018-09-21"
        },
        "registered":"yes"
      },
    "regyinfo":
      {"registrar":"CSC CORPORATE DOMAINS, INC.",
        "referrer":"http:\/\/www.cscglobal.com\/global\/web\/csc\/digital-brand-services.html",
        "servers":[
          {"server":"com.whois-servers.net","args":"domain =cnn.com","port":43},
          {"server":"whois.corporatedomains.com","args":"cnn.com","port":43}
        ],"type":"domain"
      }
  }
]
```
