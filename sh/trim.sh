#!/bin/sh

ltrim()
{
    [ $# -ne 1 ] && return 1
    printf "%s" "${1#"${1%%[![:space:]]*}"}"
    return 0
}

rtrim()
{
    [ $# -ne 1 ] && return 1
    printf "%s" "${1%"${1##*[![:space:]]}"}"
    return 0
}

trim()
{
    [ $# -ne 1 ] && return 1

    local var
    var="$1"
    var="${var#"${var%%[![:space:]]*}"}"
    var="${var%"${var##*[![:space:]]}"}"
    printf "%s" "$var"

    return 0
}
